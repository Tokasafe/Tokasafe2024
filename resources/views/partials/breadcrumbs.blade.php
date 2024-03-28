@unless ($breadcrumbs->isEmpty())
    <ul class="-z-10">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active font-bold text-teal-500">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ul>
@endunless