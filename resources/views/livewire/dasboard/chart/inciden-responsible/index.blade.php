<div>

    @push('scripts')
    @livewireScripts()
    <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
        <script>
            var file = document.getElementById("my").getContext('2d');
            var myChart = new Chart(file, {
                type: 'bar',
                data: {
                    labels: ["41", "42", "43"],
                    datasets: [{
                        label: 'Close',
                        backgroundColor: "#10b981",
                        data: [2,3,4],
                    }, {
                        label: 'Open',
                        backgroundColor: "#f43f5e",
                        data: [3,1,6],
                    }],
                },
                options: {
                    tooltips: {
                        displayColors: true,
                        callbacks: {
                            mode: 'x',
                        },
                    },
                    scales: {
                        xAxes: [{
                            stacked: true,
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                            },
                            type: 'linear',
                        }]
                    },
                    responsive: true,
                 
                }
            });
        </script>
    @endpush
    <canvas id="my"width="400" height="150"></canvas>
</div>

