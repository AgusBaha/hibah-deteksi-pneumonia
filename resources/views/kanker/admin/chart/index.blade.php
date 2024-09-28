<x-app-layout title="Categories">
    @push('style')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    <div id="question-area ">
        <a href="{{ url('/export-excel') }}" class="btn btn-primary mb-2">Download Hasil dalam Excel</a>
    </div>

    <div class="card position-relative">
        <div class="card-body shadow">
            <div style="width: 50%">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
                // Check if Chart is loaded
                if (typeof Chart === 'undefined') {
                    console.error('Chart.js is not loaded.');
                    return;
                }

                const labels = @json($categories);
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Total Yes Count by Category',
                        data: @json($yesCounts),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            });
    </script>
    @endpush
</x-app-layout>