<!DOCTYPE html>
<html lang="en">

@include('theme.partials.head')

<body>
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

@include('theme.partials.nav')


@include('theme.partials.hero')


@yield('content')

@include('theme.partials.footer')

@include('theme.partials.script')
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

</body>

</html>
