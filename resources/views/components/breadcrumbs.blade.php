<div class="d-flex align-items-end custom-breadcrumbs">
    @foreach ($breads as $bread)
        @if (!$loop->last)
            <a href="{{ $bread[1] }}" class="text-success">{{ $bread[0] }}</a>
            <span style="font-size: .9rem"><i class="fa-solid fa-chevron-right fa-xs"></i></span>
        @else
            <span>{{ $bread[0] }}</span>
        @endif
    @endforeach
</div>
