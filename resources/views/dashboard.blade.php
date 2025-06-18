<x-app-layout>

    <div class="max-w-7xl mx-auto space-y-6">
        <x-stats-card />
        <x-report-card
            :labels="$chartData['labels']"
            :values="$chartData['values']"
        />
    </div>
</x-app-layout>