const mix = require('laravel-mix')
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css');
mix.copy('node_modules/apexcharts/dist/apexcharts.js', 'public/js');

mix.copy('node_modules/flatpickr/dist/plugins/monthSelect/index.js', 'public/js/flatpickr/monthSelect')
.postCss('node_modules/flatpickr/dist/plugins/monthSelect/style.css', 'public/css/flatpickr/monthSelect')
.postCss('node_modules/flatpickr/dist/flatpickr.min.css', 'public/css/flatpickr')
.postCss('node_modules/flatpickr/dist/themes/dark.css', 'public/css/flatpickr');

