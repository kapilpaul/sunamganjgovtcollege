
<footer>

    <div class="social-icons">
        <a href="#" class="wow zoomIn"> <i class="fa fa-twitter"></i> </a>
        <a href="#" class="wow zoomIn" data-wow-delay="0.2s"> <i class="fa fa-facebook"></i> </a>
        <a href="#" class="wow zoomIn" data-wow-delay="0.4s"> <i class="fa fa-linkedin"></i> </a>
    </div>
    <p> <small class="text-muted">Copyright © 2015. All rights reserved.</small></p>

</footer>

<a href="#top" class="back_to_top"><img src="{{ asset('assets/website/images/back_to_top.png') }}" alt="back to top"></a>

<!--
 Javascripts : Nerd Stuff :)
 ====================================== -->

@stack('footer_top_js')

<script src="{{ mix('js/app.js') }}"></script>

<!-- jQuery Library -->
<script src="{{ asset('assets/website/js/jquery.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('assets/website/js/bootstrap.min.js') }}"></script>

<!-- 3rd party Plugins -->
<script src="{{ asset('assets/website/js/plugins/wow.js') }}"></script>
<script src="{{ asset('assets/website/js/plugins/slick.js') }}"></script>
<script src="{{ asset('assets/website/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ asset('assets/website/js/plugins/validate.js') }}"></script>
<script src="{{ asset('assets/website/js/plugins/appear.js') }}"></script>
{{--<script src="{{ asset('assets/website/js/plugins/count-to.js') }}"></script>--}}
{{--<script src="{{ asset('assets/website/js/plugins/nicescroll.js') }}"></script>--}}

<!-- JS Includes -->
<script src="{{ asset('assets/website/js/includes/subscribe.js') }}"></script>
<script src="{{ asset('assets/website/js/includes/contact_form.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('assets/website/js/main.js') }}"></script>

@stack('footer_js')

</body>

</html>
