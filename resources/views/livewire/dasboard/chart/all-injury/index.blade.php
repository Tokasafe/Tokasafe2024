<div>
    @push('styles')
        @livewireStyles()
        <link rel="stylesheet" href="/css/flatpickr/flatpickr.min.css">
        <link rel="stylesheet" href="/css/flatpickr/monthSelect/style.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/css/flatpickr/dark.css">
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src=" \js\flatpickr\monthSelect\index.js"></script>
        <script src=" \js\apexcharts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script></script>
        <script>
            flatpickr("#tanggal", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });

            flatpickr("#tglLapor", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#jamKejadian", {
                disableMobile: "true",
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                // time_24hr: true
            });
            flatpickr("#tgldilapor", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#month", {
                disableMobile: "true",
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true, //defaults to false
                        dateFormat: "M-Y", //defaults to "F Y"
                        altFormat: "F Y", //defaults to "F Y"
                        theme: "dark" // defaults to "light"
                    })
                ]
            });

            const tglll = $("#rangeDate").flatpickr({
                mode: 'range',
                dateFormat: "d-m-Y", //defaults to "F Y"
                onChange: function(dates) {
                    if (dates.length === 2) {
                        // var d = new Date(dates[0]);
                        var start = new Date(dates[0]);
                        var end = new Date(dates[1]);


                        console.log(start);
                        // console.log(end);
                        livewire.emit('TglMulai', start);
                        livewire.emit('TglAkhir', end);
                    }
                }
            })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var options = {
                series: [{
                    name: 'Website Blog',
                    type: 'column',
                    data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160,440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
                }, {
                    name: 'Social Media',
                    type: 'line',
                    data: [,23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16,23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
                }],
                chart: {
                    height: 350,
                    type: 'line',
                },
                stroke: {
                    width: [0, 4]
                },
                title: {
                    text: 'Traffic Sources'
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                },
                labels: ['01 Jan 2001 ', '02 Jan 2001 ', '03 Jan 2001 ', '04 Jan 2001 ', '05 Jan 2001 ', '06 Jan 2001 ',
                    '07 Jan 2001 ', '08 Jan 2001 ', '09 Jan 2001 ', '10 Jan 2001 ', '11 Jan 2001 ', '12 Jan 2001 ',
                    '01 Jan 2002', '02 Jan 2002', '03 Jan 2002', '04 Jan 2002', '05 Jan 2002', '06 Jan 2002',
                    '07 Jan 2002', '08 Jan 2002', '09 Jan 2002', '10 Jan 2002', '11 Jan 2002', '12 Jan 2002'
                ],
                xaxis: {
                    datetime: ['01 Jan 2001 ', '02 Jan 2001 ', '03 Jan 2001 ', '04 Jan 2001 ', '05 Jan 2001 ', '06 Jan 2001 ',
                    '07 Jan 2001 ', '08 Jan 2001 ', '09 Jan 2001 ', '10 Jan 2001 ', '11 Jan 2001 ', '12 Jan 2001 ',
                    '01 Jan 2002', '02 Jan 2002', '03 Jan 2002', '04 Jan 2002', '05 Jan 2002', '06 Jan 2002',
                    '07 Jan 2002', '08 Jan 2002', '09 Jan 2002', '10 Jan 2002', '11 Jan 2002', '12 Jan 2002'
                ]
                },
                yaxis: [{
                    title: {
                        text: 'Website Blog',
                    },

                }, {
                    opposite: true,
                    title: {
                        text: 'Social Media'
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>
    @endpush
    @section('content')
        <div class="flex flex-col-reverse sm:flex-row ">

            <div class="sm:col-span-3 grow">
                <div class="self-center p-4">
                    <h3 class="font-bold text-xl sm:text-3xl text-center">TOKA SAFE Performance Flash Report</h3>
                </div>

                <div class="px-4  ">
                    <!-- Chart -->
                    @livewire('dasboard.chart.kpi.index')
                    <div class="relative sm:h-auto sm:w-full  bg-stone-200 rounded-sm mt-2">
                        <div class="" id="chart">
                        </div>
                    </div>
                </div>
                <div class="m-4 self-center">
                </div>
                <div class="mx-8 lg:mx-0">
                    @livewire('dasboard.chart.key-state.index')
                </div>
                <div class="grid sm:grid-cols-2 grid-rows-4 gap-2 m-4">
                    <div class="bg-blue-400">01</div>
                    <div class="bg-emerald-400">01</div>
                    <div class="bg-rose-400">01</div>
                    <div class="bg-yellow-400">09</div>
                </div>
            </div>
            <div class=" flex-none sm:mt-14 px-4 ">
                <div class="w-full join p-2">
                    <input
                        class="font-semibold text-sm join-item input input-sm input-primary w-full focus:outline-none focus:border-primary focus:ring-primary focus:ring-0"
                        value="Hazard Report" readonly />
                    <div class="join-item"> @livewire('event-report-list.hazard-id.create')</div>
                </div>

            </div>
        </div>
    @endsection
</div>
