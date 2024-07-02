<div class="mt-4">
    @include('toast.toast')
    @push('styles')
        @livewireStyles()
        <link rel="stylesheet" type="text/css" href="{{ asset('toastify/css/toastify.css') }}">
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="{{ asset('toastify/js/toastify.js') }}"></script>
        <script>
            const modalDel = document.getElementById("closeModalDel");
            $(document).on('click', '#closeDel', function() {
                modalDel.click()
            });
        </script>
    @endpush


    <div role="tablist" class="tabs tabs-lifted">

        <input type="radio" name="my_tabs_1" role="tab" class="tab font-bold radio radio-primary" 
            aria-label="Depertement Group"checked />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">@include('livewire.department-group.dept-group')</div>
        <input type="radio" name="my_tabs_1" role="tab" class="tab font-bold" aria-label="Group" />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6"> @livewire('department-group.group.index')</div>


    </div>



</div>
