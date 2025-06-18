@php
$menuItems = [
    ['icon' => 'bar-chart-3', 'label' => 'Progress', 'active' => true, 'color' => 'text-orange-500'],
    ['icon' => 'building-2', 'label' => 'Sentra Ekonomi', 'active' => false, 'color' => 'text-blue-500'],
    ['icon' => 'file-text', 'label' => 'Assignment', 'active' => false, 'color' => 'text-cyan-500'],
    ['icon' => 'store', 'label' => 'Usaha', 'active' => false, 'color' => 'text-green-500'],
    ['icon' => 'upload', 'label' => 'Upload', 'active' => false, 'color' => 'text-red-500'],
];
$suplemenItems = [
    ['icon' => 'users', 'label' => 'Usaha Suplemen', 'color' => 'text-yellow-500'],
    ['icon' => 'upload', 'label' => 'Upload Suplemen', 'color' => 'text-pink-500'],
    ['icon' => 'download', 'label' => 'Download Project Suplemen', 'color' => 'text-purple-500'],
];
@endphp

{{-- Backdrop untuk mobile --}}
<div x-show="sidebarOpen"
    @click.away="sidebarOpen = false"
    class="fixed inset-0 bg-transparent opacity-25 z-40 xl:hidden"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-end="opacity-0"
    style="display: none;">
</div>

{{-- Container Sidebar Utama --}}
<aside class="fixed inset-y-0 left-0 w-72 bg-white shadow-xl z-50
               transform transition-transform duration-300 ease-in-out"
       :class="{
          'translate-x-0': sidebarOpen,
          '-translate-x-full': !sidebarOpen
       }">

    <div class="w-72 h-full flex flex-col overflow-hidden" :class="{ 'xl:w-72': sidebarOpen, 'xl:w-0': !sidebarOpen }">
        <button @click="sidebarOpen = false" class="absolute top-4 right-4 p-2 rounded-lg hover:bg-gray-100 xl:hidden z-10" aria-label="Close Sidebar">
            <x-lucide-x class="w-5 h-5 text-gray-500" />
        </button>

        <div class="p-6 border-b border-gray-100" :class="{ 'xl:opacity-100': sidebarOpen, 'xl:opacity-0': !sidebarOpen }">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-lg">KD</span>
                </div>
                <div>
                    <h2 class="font-bold text-gray-800 text-lg">KEN DEDES</h2>
                    <p class="text-sm text-gray-500 font-semibold">Kendali Direktori Ekonomi</p>
                </div>
            </div>
        </div>

        <div class="flex-grow p-4 space-y-6 overflow-y-auto" :class="{ 'xl:opacity-100': sidebarOpen, 'xl:opacity-0': !sidebarOpen }">
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-3">DIREKTORI SENTRA EKONOMI</h3>
                <nav class="space-y-1">
                    @foreach ($menuItems as $item)
                        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors duration-200 {{ $item['active'] ? 'bg-orange-50 text-orange-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }}">
                            <x-dynamic-component :component="'lucide-' . $item['icon']" class="h-5 w-5 {{ $item['active'] ? 'text-orange-500' : $item['color'] }}" />
                            <span class="font-medium text-sm">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-3">DIREKTORI SUPLEMEN</h3>
                <nav class="space-y-1">
                    @foreach ($suplemenItems as $item)
                        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-800 transition-colors duration-200">
                            <x-dynamic-component :component="'lucide-' . $item['icon']" class="h-5 w-5 {{ $item['color'] }}" />
                            <span class="font-medium text-sm">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
            <div class="border-t border-gray-100 flex-shrink-0 pt-6" :class="{ 'xl:opacity-100': sidebarOpen, 'xl:opacity-0': !sidebarOpen }">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-3">PETUGAS</h3>
                <a href="#" class="flex items-center space-x-3 px-3 py-3rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-800 transition-colors duration-200">
                    <x-lucide-user-plus class="w-5 h-5 text-gray-500" />
                    <span class="font-medium text-sm">Manajemen Petugas</span>
                </a>
            </div>
        </div>

    </div>
</aside>