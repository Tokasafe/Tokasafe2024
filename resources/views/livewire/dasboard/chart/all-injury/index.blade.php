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
                chart: {
                    height: 350,
                    type: "line",
                    stacked: false
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#99C2A2', '#C5EDAC', '#66C7F4'],
                series: [

                    {
                        name: 'Column A',
                        type: 'column',
                        data: [21.1, 23, 33.1, 34, 44.1, 44.9, 56.5, 58.5]
                    },
                    {
                        name: "Column B",
                        type: 'column',
                        data: [10, 19, 27, 26, 34, 35, 40, 38]
                    },
                    {
                        name: "Line C",
                        type: 'line',
                        data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                    },
                ],
                stroke: {
                    width: [4, 4, 4]
                },
                plotOptions: {
                    bar: {
                        columnWidth: "20%"
                    }
                },
                xaxis: {
                    categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016]
                },
                yaxis: [{
                        seriesName: 'Column A',
                        axisTicks: {
                            show: true
                        },
                        axisBorder: {
                            show: true,
                        },
                        title: {
                            text: "Columns"
                        }
                    },
                    {
                        seriesName: 'Column A',
                        show: false
                    }, {
                        opposite: true,
                        seriesName: 'Line C',
                        axisTicks: {
                            show: true
                        },
                        axisBorder: {
                            show: true,
                        },
                        title: {
                            text: "Line"
                        }
                    }
                ],
                tooltip: {
                    shared: false,
                    intersect: true,
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
                xaxis: {
                    type: 'datetime',
                    categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
                        '01/05/2011 GMT', '01/06/2011 GMT'
                    ],
                },
                legend: {
                    position: 'right',
                    offsetY: 40
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
                        name: "High - 2013",
                        data: [28, 29, 33, 36, 32, 32, 33]
                    },
                    {
                        name: "Low - 2013",
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
                colors: ['#77B6EA', '#545454'],
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: 'Average High & Low Temperature',
                    align: 'left'
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
                yaxis: {
                    title: {
                        text: 'Temperature'
                    },
                    min: 5,
                    max: 40
                },
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
                    height: 350,
                    width: 380,
                    type: 'donut',
                },
                plotOptions: {
                    pie: {
                        startAngle: -90,
                        endAngle: 270
                    }
                },
                dataLabels: {
                    enabled: false
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
            };

            var chart = new ApexCharts(document.querySelector("#chartColumne"), options);
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
                        <div class="" id="chart"></div>
                    </div>
                </div>
                <div class="m-4 self-center">
                </div>
                <div class="mx-8 lg:mx-0">
                    @livewire('dasboard.chart.key-state.index')
                </div>
                <div class="grid sm:grid-cols-2 grid-rows-4 gap-2 m-4">
                    <div id="chartLine"></div>
                    <div id="chartStackedColumns"></div>
                    <div id="chartDonute"></div>
                    <div id="chartColumne"></div>
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
