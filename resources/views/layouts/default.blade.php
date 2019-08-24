@include('layouts.partials.header')

<div id="sunamganj-college">
    <div id="page-wrapper">
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>Sunamganj College</strong></h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie10"></div>
            </div>
        </div>
        <!-- END Preloader -->

        <div id="page-container" class="header-fixed-top sidebar-partial sidebar-visible-lg sidebar-no-animations">
            @include('layouts.partials.menu')

            <!-- Main Container -->
            <div id="main-container">
                @include('layouts.partials.header_top')

                <!-- Page content -->
                <div id="page-content">
                    @yield('main_content')
                </div>
                <!-- END Page Content -->

                @include('layouts.partials.footer_top')
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->
</div>

@include('layouts.partials.footer')
