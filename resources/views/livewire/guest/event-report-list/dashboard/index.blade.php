<div>
 @extends('dashboard')
 @push('styles')
 @livewireStyles()
 <link rel="stylesheet" href="../../flatpickr/dist/flatpickr.min.css">
 <link rel="stylesheet" href="../../flatpickr/dist/plugins/monthSelect/style.css" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="../../flatpickr/dist/themes/dark.css">
@endpush
@push('scripts')
 @livewireScripts()
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"
     integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 <script src="../../flatpickr/dist/plugins/monthSelect/index.js"></script>
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
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script>
     const ctx = document.getElementById('all_injuryChart');
     new Chart(ctx, {
         data: {
             datasets: [{
                     type: 'line',
                     label: 'LTFR ',
                     data: [50, 30, 50, 50],
                     backgroundColor: '#10b981',
                     borderColor: '#f97316',
                 },
                 {
                     type: 'line',
                     label: 'LTFR Target',
                     data: [10, 10, 10, 10],
                     borderDash: [10, 10, 10, 10],
                     backgroundColor: '#14b8a6',
                     borderColor: '#f87171',
                 },
                 {
                     type: 'bar',
                     label: 'LTI',
                     data: [10],
                     backgroundColor: '#e11d48',

                 },
                 {
                     type: 'bar',
                     label: 'RDI',
                     data: [20],
                     backgroundColor: '#ec4899',
                 },
                 {
                     type: 'bar',
                     label: 'MTI',
                     data: [15],
                     backgroundColor: '#0ea5e9',
                 },
                 {
                     type: 'bar',
                     label: 'FAI',
                     data: [22],
                     backgroundColor: '#10b981',
                 }


             ],
             labels: ['January', 'February', 'March', 'April']
         },

     });
 </script>
@endpush
@section('contentUser')
 <div class="flex flex-col-reverse sm:flex-row ">

     <div class="sm:col-span-3 grow">
         <div class="self-center p-4">
             <h3 class="font-bold text-xl sm:text-3xl text-center">TOKA SAFE Performance Flash Report</h3>
         </div>

         <div class="px-4  ">
             <!-- Chart -->
             <div class="relative sm:h-auto sm:w-auto bg-stone-200 rounded-sm">
                 <canvas id="all_injuryChart"></canvas>
             </div>
         </div>
         <div class="m-4 self-center">
             @livewire('dasboard.chart.key-state.index')
         </div>
         <div class="mx-8 lg:mx-0">
             @livewire('dasboard.chart.kpi.index')
         </div>
         <div class="grid sm:grid-cols-2 grid-rows-4 gap-2 m-4">
             <div class="bg-blue-400">01</div>
             <div class="bg-emerald-400">01</div>
             <div class="bg-rose-400">01</div>
             <div class="bg-yellow-400">09</div>
         </div>
     </div>
     <div class=" flex-none sm:mt-14 px-4">



         <div class="w-full join p-2">
             <input
                 class="font-semibold text-sm join-item input input-sm input-primary w-full focus:outline-none focus:border-primary focus:ring-primary focus:ring-0"
                 value="Hazard Report" readonly />
             <div class="join-item"> @livewire('event-report-list.hazard-id.create')</div>
         </div>

     </div>
 </div>
 @stop
</div>
