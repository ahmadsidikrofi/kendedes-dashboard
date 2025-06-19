@props([
    'labels' => [],
    'values' => []
])

<div class="bg-white rounded-xl shadow-sm p-6" x-data="reportChart({{ json_encode(array_values($labels)) }}, {{ json_encode(array_values($values)) }})">
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">
            Report Jumlah Usaha Berdasarkan Kabupaten/Kota
        </h3>
        <p class="text-gray-600 text-sm mb-2">
            <span class="font-medium text-gray-700">Report tidak realtime</span>,
            report akan diupdate pada jam <span class="font-medium">06.00, 12.00, 18.00, 22.30</span>
        </p>
        <p class="text-gray-500 text-sm">
            Kondisi tanggal: <span class="font-medium">23 May 2025 18:00</span>
        </p>
    </div>

    <div class="mb-8">
        <button class="inline-flex items-center space-x-2 bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-3 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl">
            <x-lucide-download class="w-5 h-5" />
            <span>Download Report Di Sini</span>
        </button>
    </div>

    <div class="mb-4">
        <div class="flex items-center justify-center mb-4">
            <div class="flex items-center space-x-2 bg-cyan-50 px-3 py-1 rounded-full">
                <div class="w-3 h-3 bg-cyan-400 rounded-full"></div>
                <span class="text-sm font-medium text-cyan-700">
                    Progres Pemutakhiran Sentra Ekonomi
                </span>
            </div>
        </div>

        <div class="relative h-64 bg-gradient-to-t from-gray-50 to-white rounded-lg p-4">
            <div class="absolute left-0 top-0 h-full flex flex-col justify-between text-xs text-gray-600 pr-2">
                <template x-for="label in yAxisLabels" :key="label">
                    <span x-text="label"></span>
                </template>
            </div>

            <div class="ml-12 h-full relative">
                <div class="absolute inset-0">
                    <template x-for="percent in [0, 25, 50, 75, 100]" :key="percent">
                        <div class="absolute w-full border-t border-gray-200" :style="`top: ${percent}%`"></div>
                    </template>
                </div>

                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <polyline fill="none" stroke="url(#chartGradient)" stroke-width="2" :points="polylinePoints" />
                    <defs>
                        <linearGradient id="chartGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#06B6D4" />
                            <stop offset="100%" stop-color="#10B981" />
                        </linearGradient>
                    </defs>
                </svg>
                <div class="absolute -bottom-6 left-12 right-0 h-6 flex justify-between text-xs text-gray-500">
                    <template x-for="label in chartLabels" :key="label">
                        <span class="transform -rotate-45" x-text="label"></span>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
        <x-lucide-trending-up class="w-4 h-4 text-green-500" />
        <span>Trend peningkatan positif dalam pemutakhiran data</span>
    </div>
</div>

<script>
    function reportChart(labels, values) {
        return {
            chartLabels: labels,
            chartValues: values,
            yAxisLabels: [],
            dataPoints: [],
            polylinePoints: '',
            init() {
                if (this.chartValues.length === 0) return;

                const minValue = Math.min(...this.chartValues);
                const maxValue = Math.max(...this.chartValues);

                // Membuat label Y-axis secara dinamis
                this.yAxisLabels = [];
                const stepCount = 4; // Jumlah step label (misal: 5 label)
                for (let i = stepCount; i >= 0; i--) {
                    const value = minValue + (i/stepCount) * (maxValue - minValue);
                    this.yAxisLabels.push(this.formatNumber(value));
                }

                this.dataPoints = this.chartValues.map((value, index) => {
                    const x = (index / (this.chartValues.length - 1)) * 100;
                    const y = 100 - ((value - minValue) / (maxValue - minValue)) * 100;
                    // Handle jika hanya ada 1 data point
                    if (this.chartValues.length === 1) {
                        return { x: 50, y: 50 };
                    }
                    return { x, y };
                });

                this.polylinePoints = this.dataPoints.map(p => `${p.x},${p.y}`).join(' ');
            },
            formatNumber(num) {
                return new Intl.NumberFormat('id-ID').format(Math.round(num));
            }
        }
    }
</script>