<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
@stack('footer_top_js')

<script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

@stack('footer_js')

<!-- Load and execute javascript code used only in this page -->

@if(isset($indexjs))
<script src="{{ asset('assets/js/pages/index.js') }}"></script>
<script>
    $(function () {
        Index.init();
    });
</script>
@endif

@stack('footer_bottom_js')

@if(session('access_token'))
    <script>
        localStorage.setItem('token', '{{ session('access_token') }}');
        localStorage.setItem('expiration', '{{ session('expiration') }}' + Date.now());
    </script>
    @endif
</body>
</html>