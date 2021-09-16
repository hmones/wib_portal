@if ($paginator->hasPages())
    <div class="ui pagination menu" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"> <i
                    class="left chevron icon"></i> </a>
        @else
            <a wire:click="previousPage" wire:loading.attr="disabled" class="icon item" href="javascript:void(0);"
               rel="prev" aria-label="@lang('pagination.previous')">
                <i class="left chevron icon"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="icon item disabled" aria-disabled="true">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a wire:click="gotoPage({{$page}})" wire:loading.attr="disabled" class="item active"
                           href="javascript:void(0);" aria-current="page">{{ $page }}</a>
                    @else
                        <a wire:click="gotoPage({{$page}})" wire:loading.attr="disabled" class="item"
                           href="javascript:void(0);">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a wire:click="nextPage" wire:loading.attr="disabled" class="icon item" href="javascript:void(0);"
               rel="next" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @else
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"> <i
                    class="right chevron icon"></i> </a>
        @endif
    </div>
@endif
