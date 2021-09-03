<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.partials.header')
    <livewire:styles/>
</head>
<body>
@include('admin.partials.navigation')
<div class="pusher">
    <div class="ui grid">
        <div class="mobile only row">
            <div class="column">
                <div class="ui inverted basic segment">
                    <a href="javascript:void(0)" onclick="$('.ui.sidebar').sidebar('toggle');">
                        <i class="inverted bars icon"></i>
                    </a>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="ui grid">
        <div class="computer tablet only row">
            <div class="column"><br><br></div>
        </div>
    </div>
    @if($breadcrumbItems)
        @include('components.breadcrumb', compact('breadcrumbItems'))
    @endif
    @include('partials.flash-message')
    @yield('content')
    @yield('scripts')
    <script>
        if (window.innerWidth > 768) {
            $('.ui.sidebar').addClass('visible');
        }
    </script>
    <livewire:scripts/>
</div>
</body>
</html>
