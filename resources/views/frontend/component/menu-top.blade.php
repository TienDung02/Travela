<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0">
        <a href="{{ route('home.index') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'home.index' ? 'active' : '' }}">Home</a>
        <a href="{{ route('about.index') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'about.index' ? 'active' : '' }}">About</a>
        <a href="{{ route('service.index') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'service.index' ? 'active' : '' }}">Services</a>
        <a href="{{ route('package.index') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'package.index' ? 'active' : '' }}">Packages</a>
        <a href="{{ route('blog.index') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'blog.index' ? 'active' : '' }}">Blog</a>
        <a href="{{ route('destination.index') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'destination.index' ? 'active' : '' }}">Destination</a>
        <a href="{{ route('tour.index') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'tour.index' ? 'active' : '' }}">Explore Tour</a>
    </div>
</div>
