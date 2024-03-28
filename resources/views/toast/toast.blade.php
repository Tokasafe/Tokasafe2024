<div class="mr-4">
    @if (Session::has('success'))
        <script>
            toastr.options.extendedTimeOut = "2000";
            toastr.options.hideDuration = "2000";
            toastr.options.timeOut = "2000";
            toastr.options.showDuration = "300";
            toastr.success("{!! Session::get('success') !!}")
        </script>
    @elseif(Session::has('error'))
        <script>
            toastr.error("{!! Session::get('error') !!}")
        </script>
    @endif
</div>
