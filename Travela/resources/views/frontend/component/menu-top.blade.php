<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0">
        <a href="{{route('home.index')}}" class="nav-item nav-link">Home</a>
        <a href="{{route('about.index')}}" class="nav-item nav-link">About</a>
        <a href="{{route('service.index')}}" class="nav-item nav-link">Services</a>
        <a href="{{route('package.index')}}" class="nav-item nav-link">Packages</a>
        <a href="{{route('blog.index')}}" class="nav-item nav-link">Blog</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
            <div class="dropdown-menu m-0">
                <a href="../destination/index.blade.php" class="dropdown-item">Destination</a>
                <a href="../tour/index.blade.php" class="dropdown-item">Explore Tour</a>
                <a href="../booking/index.blade.php" class="dropdown-item">Travel Booking</a>
                <a href="gallery.html" class="dropdown-item">Our Gallery</a>
                <a href="guides.html" class="dropdown-item">Travel Guides</a>
                <a href="../testimonial/index.blade.php" class="dropdown-item">Testimonial</a>
                <a href="../404.blade.php" class="dropdown-item">404 Page</a>
            </div>
        </div>
        <a href="{{route('contact.index')}}" class="nav-item nav-link">Contact</a>
    </div>
    <a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>
</div>
