<header class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <div class="flex items-center justify-between">
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"
            aria-label="Toggle Menu"
        >
            <x-lucide-menu class="w-6 h-6 text-gray-600" />
        </button>
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <p class="text-sm text-gray-500">{{ now()->translatedFormat('l, j F') }}</p>
                <p class="text-sm font-medium text-gray-700">{{ now()->format('H:i') }}</p>
            </div>
        </div>
    </div>
</header>