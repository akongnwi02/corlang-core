<!DOCTYPE html>
@langrtl
    <html lang="{{ app()->getLocale() }}" dir="rtl">
@else
    <html lang="{{ app()->getLocale() }}">
@endlangrtl
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Corlang Core')">
    <meta name="author" content="@yield('meta_author', 'Che Devert')">
    <link rel="icon" href="{!! asset('img/backend/brand/logo/logo-browser-icon.png') !!}"/>
@yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}

    @stack('after-styles')
</head>

<body class="{{ config('backend.body_classes') }}">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.logged-in-to-company')
            @include('includes.partials.logged-in-as')
            {!! Breadcrumbs::render() !!}

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('frontend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')
</body>
        <script>
        /* Recover sidebar state */
        if (Boolean(sessionStorage.getItem('sidebar-collapsed'))) {
            let body = document.getElementsByTagName('body')[0];
            body.className = body.className.replace('sidebar-lg-show', '');
        }

        /* Store sidebar state */
        let navbarToggler = document.getElementsByClassName("navbar-toggler");
        for (let i = 0; i < navbarToggler.length; i++) {
            navbarToggler[i].addEventListener('click', function(event) {
                event.preventDefault();
                if (Boolean(sessionStorage.getItem('sidebar-collapsed'))) {
                    sessionStorage.setItem('sidebar-collapsed', '');
                } else {
                    sessionStorage.setItem('sidebar-collapsed', '1');
                }
            });
        }
    </script>
</html>
