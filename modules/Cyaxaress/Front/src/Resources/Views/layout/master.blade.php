<!doctype html>
<html lang="fa">
@include('Front::layout.head')
<body >
@include('Front::layout.header')
<main id="index">
    @yield('content')
</main>
@include('Front::layout.footer')
@include('Front::layout.foot')
</body>
</html>
