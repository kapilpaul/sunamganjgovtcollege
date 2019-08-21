<!-- Fixed Top Header Header -->
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-show_big_thumbnails"></i>{{ $pageTitle }}
        </h1>
    </div>
</div>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ $pageUrl }}">{{ $pageTitle }}</a></li>
</ul>
<!-- END Fixed Top Header Header -->

@include('layouts.partials.session-msg')
