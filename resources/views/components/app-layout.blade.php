<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KEN DEDES | Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-orange-400 via-orange-300 to-yellow-300">
    <div x-data="{ sidebarOpen: window.innerWidth >= 1280 }" @resize.window="sidebarOpen = window.innerWidth >= 1280"
        class="relative min-h-screen flex">
        <div>
            <x-sidebar />
        </div>

        <main class="flex-1 flex flex-col transition-all duration-300 ease-in-out" :class="{ 'xl:ml-72': sidebarOpen }">
            <div class="p-4 xl:p-6">
                <x-header />
                <div >
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

</body>

</html>
