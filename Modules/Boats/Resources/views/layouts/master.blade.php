<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('common.head')

    {{-- boats - CSS File --}}
    <link rel="stylesheet" href="{{ mix('css/boats.css') }}">

</head>

<body>
    @include('common.header')

    @yield('content')

    @include('common.footer')

    @include('common.foot')

    {{-- boats - JS File --}}
    <script src="{{ mix('js/boats.js') }}"></script>
</body>

</html>