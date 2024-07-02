const mix = require('laravel-mix')
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css');
mix.copy('node_modules/apexcharts/dist/apexcharts.js', 'public/apexcharts');
mix.copy('node_modules/flatpickr/dist/plugins/rangePlugin.js', 'public/rangePlugin/js');
mix.copy('node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js', 'public/ckeditor/classic/js');
mix.copy('node_modules/ckeditor5/dist/index.js', 'public/ckeditor5/js').postCss('node_modules/ckeditor5/dist/index.css', 'public/ckeditor5/css');
mix.copy('node_modules/toastify-js/src/toastify.js', 'public/toastify/js').postCss('node_modules/toastify-js/src/toastify.css', 'public/toastify/css');

mix.copy('node_modules/flatpickr/dist/plugins/monthSelect/index.js', 'public/js/flatpickr/monthSelect')
.postCss('node_modules/flatpickr/dist/plugins/monthSelect/style.css', 'public/css/flatpickr/monthSelect')
.postCss('node_modules/flatpickr/dist/flatpickr.min.css', 'public/css/flatpickr')
.postCss('node_modules/flatpickr/dist/themes/dark.css', 'public/css/flatpickr');

