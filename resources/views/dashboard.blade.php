<x-app-layout>
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <h3 class="font-semibold text-gray-800 mb-4">Upload Laporan Excel</h3>
        <form action="{{ route('report.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="report_file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" required>
            <button type="submit" class="mt-4 px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">Upload dan Tampilkan Grafik</button>
        </form>
    </div>

    {{-- @if(config('app.debug'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
            <strong>Debug Info:</strong><br>
            Labels: {{ json_encode($chartData['labels'] ?? []) }}<br>
            Values: {{ json_encode($chartData['values'] ?? []) }}
        </div>
    @endif --}}

    <div class="max-w-7xl mx-auto space-y-6">
        <x-stats-card />
        <x-report-card
            :labels="$chartData['labels'] ?? []"
            :values="$chartData['values'] ?? []"
        />
    </div>
</x-app-layout>