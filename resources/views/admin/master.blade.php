@include('admin.components.header')

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        @include('admin.components.nav')
        <!-- Topbar -->
        @if (session('status') && session('color'))
            <div class="alert alert-{{ session('color') }} max-w-96 text-sm ">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>
@include('admin.components.footer')
