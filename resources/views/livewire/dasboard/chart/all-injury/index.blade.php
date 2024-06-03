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
        <script>
            var options = {
                chart: {
                    height: 350,
                    type: "line",
                    stacked: false
                },
                dataLabels: {
                    enabled: false,
                    enabledOnSeries: [4]
                },
                colors: ['#F11C3F', '#F9C01E', '#F1FC0F', '#03B301', '#0198B3', '#FF1919'],
                series: [{
                        name: 'LTI',
                        type: 'column',
                        data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                    }, {
                        name: 'RDI',
                        type: 'column',
                        data: [1.1, 1, 1.1, 4, 4.1, 2.9, 3.5, 4.5]
                    },
                    {
                        name: 'MTI',
                        type: 'column',
                        data: [1, 3, 3, 2, 5, 4, 2, 1]
                    },
                    {
                        name: 'FAI',
                        type: 'column',
                        data: [2, 3, 3, 1, 2, 1, 3, 4]
                    }, {
                        name: 'LTIFR',
                        type: 'line',
                        data: [0, 0, 1, 1, 1, 0.4, 0, 0]
                    }, {
                        name: 'LTIFR_Target',
                        type: 'line',
                        data: [0.15, 0.15, 0.15, 0.15, 0.15, 0.15, 0.15, 0.15]
                    }
                ],
                stroke: {
                    width: [2, 2, 2, 2, 2, 2],
                    dashArray: [0, 0, 0, 0, 0, 2],
                },
                plotOptions: {
                    bar: {
                        columnWidth: "30%"
                    }
                },
                xaxis: {
                    categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016]
                },
                yaxis: {
                    min: 0,

                    labels: {
                        show: false
                    }
                },

                tooltip: {
                    shared: true,
                    intersect: false,
                    x: {
                        show: false
                    }
                },
                legend: {
                    horizontalAlign: "left",
                    offsetX: 40
                }
            };
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>
        <script>
            var options = {
                series: [{
                    name: 'PRODUCT A',
                    data: [44, 55, 41, 67, 22, 43]
                }, {
                    name: 'PRODUCT B',
                    data: [13, 23, 20, 8, 13, 27]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                plotOptions: {

                    bar: {
                        columnWidth: "30%",
                        horizontal: false,
                        borderRadius: 10,
                        dataLabels: {
                            total: {
                                enabled: true,
                                style: {
                                    fontSize: '13px',
                                    fontWeight: 900
                                }
                            }
                        }
                    },
                },
                colors: ['#F11C3F', '#F9C01E'],
                xaxis: {
                    type: 'datetime',
                    categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
                        '01/05/2011 GMT', '01/06/2011 GMT'
                    ],
                },
                title: {
                    text: 'OHS Incident Responsible By Department  and Contractors in 2023',
                    align: 'left',

                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '10px',
                        fontWeight: 'bold',
                        fontFamily: undefined,
                    },
                },
                fill: {
                    opacity: 1
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartStackedColumns"), options);
            chart.render();
        </script>
        <script>
            var options = {

                series: [{
                        name: "Total Lead",
                        data: [28, 29, 33, 36, 32, 32, 33]
                    },
                    {
                        name: "Incident",
                        data: [12, 11, 14, 18, 17, 13, 13]
                    }
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#F11C3F', '#F9C01E'],
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    width: [3, 3],
                    curve: 'straight'
                },

                title: {
                    text: '12 Mths Lagging & Leading Indicator',
                    align: 'left',
                    style: {
                        fontSize: '12px',
                        fontWeight: 'bold',
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                markers: {
                    size: 1
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    title: {
                        text: 'Month'
                    }
                },
                yaxis: [{
                        seriesName: 'Total Lead',
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#F11C3F'
                        },
                        labels: {
                            style: {
                                colors: '#F11C3F',
                            }
                        },
                        title: {
                            text: 'Total Lead',
                            style: {
                                color: '#F11C3F',
                                fontSize: '12px',
                                fontWeight: 'bold',
                                fontFamily: undefined,
                            }
                        },
                    },
                    {
                        opposite: true,
                        seriesName: 'Incident',
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#F9C01E'
                        },
                        labels: {
                            style: {
                                colors: '#F9C01E',
                            }
                        },
                        title: {
                            text: 'Incident',
                            style: {
                                color: '#F9C01E',
                                fontSize: '12px',
                                fontWeight: 'bold',
                                fontFamily: undefined,
                            }
                        },
                    }
                ],
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartLine"), options);
            chart.render();
        </script>
        <script>
            var options = {
                series: [44, 15],
                chart: {

                    width: 380,
                    type: 'donut',
                },
                colors: ['#F11C3F', '#F9C01E'],
                plotOptions: {
                    pie: {
                        startAngle: 0,
                        endAngle: 360,

                    }
                },
                dataLabels: {
                    enabled: true
                },
                fill: {
                    type: 'gradient',
                },
                legend: {
                    formatter: function(val, opts) {
                        return val + " - " + opts.w.globals.series[opts.seriesIndex]
                    }
                },
                title: {
                    text: 'Gradient Donut with custom Start-angle'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chartDonute"), options);
            chart.render();
        </script>
        <script>
            var options = {
                series: [{
                    name: 'PRODUCT A',
                    data: [44, 55, 41, 67, 22, 43, 21, 49]
                }, {
                    name: 'PRODUCT B',
                    data: [13, 23, 20, 8, 13, 27, 33, 12]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    stackType: '100%'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                xaxis: {
                    categories: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2',
                        '2012 Q3', '2012 Q4'
                    ],
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'right',
                    offsetX: 0,
                    offsetY: 50
                },
                colors: ['#F11C3F', '#F9C01E'],
            };

            var chart = new ApexCharts(document.querySelector("#chartColumne"), options);
            chart.render();
        </script>
    @endpush
    @section('content')
        <div class="flex flex-col-reverse sm:flex-row ">

            <div class="sm:col-span-3 grow">
                <div class="self-center p-4">
                    <h3 class="text-xl font-bold text-center sm:text-3xl">TOKA SAFE Performance Flash Report</h3>
                </div>

                <div class="px-4 ">
                    <!-- Chart -->
                    @livewire('dasboard.chart.kpi.index')
                    <div class="relative mt-2 rounded-sm bg-zinc-400">
                        <div class="" id="chart"></div>
                    </div>
                </div>
                <div class="self-center m-4">
                </div>
                <div class="mx-8 lg:mx-0">
                    @livewire('dasboard.chart.key-state.index')
                </div>
                <div class="grid gap-2 m-4 sm:grid-cols-2">
                    <div class="bg-zinc-400" id="chartLine"></div>
                    <div class="bg-zinc-400"id="chartStackedColumns"></div>
                    <div class="bg-zinc-400"id="chartDonute"></div>
                    <div class="bg-zinc-400"id="chartColumne"></div>
                </div>
            </div>
            <div class="flex-none sm:mt-14">
                <div class="w-full p-2 join ">
                    <div class="w-full shadow-md card sm:w-36 bg-base-100 text-primary-content">
                        {{-- <div class="p-0 text-xs divider divider-info">Short Menu</div> --}}
                        <div class="flex justify-center p-0 card-body ">
                            <div class="self-center">
                                @livewire('dasboard.short-link.index')
                                <div class="invisible h-0 p-0">
                                    @livewire('event-report-list.insident.create')
                                    @livewire('event-report-list.hazard-id.create')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
</div>
