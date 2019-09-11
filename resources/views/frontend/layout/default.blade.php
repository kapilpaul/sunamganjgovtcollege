@include('frontend.layout.partials.header')

@include('frontend.layout.partials.menu')

@if(isset($home))
    @include('frontend.layout.partials.home_header_top')
@else
    @include('frontend.layout.partials.header_top')
@endif

<div id="sunamganj-college">
    @yield('main_content')
</div>

@include('frontend.layout.partials.footer')
