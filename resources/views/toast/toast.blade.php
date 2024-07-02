<div class="mr-4">
    @if (Session::has('success'))
        <script>
            Toastify({
                text: "{!! Session::get('success') !!}",
                duration: 3000,
                destination: '/contact',
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                positionLeft: false, // `true` or `false`
                backgroundColor: "#10b981"
            }).showToast();
        </script>
    @elseif(Session::has('error'))
        <script>
            Toastify({
                text: "{!! Session::get('error') !!}",
                duration: 3000,
                destination: '/contact',
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                positionLeft: false, // `true` or `false`
                backgroundColor: "#f43f5e"
            }).showToast();
        </script>
    @endif
</div>
