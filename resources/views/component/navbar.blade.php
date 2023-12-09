<div class="d-flex justify-content-center position-fixed w-100 bg-black" data-aos="fade-down"
    style="z-index: 9999 !important;">
    <nav class="navbar w-100 container px-3 px-md-0" id="navbar">
        <div class="d-flex justify-content-start">
            <img src="./img/logo.jpg" alt="" style="width: 150px; height: 80px; cursor: pointer;"
                onclick="window.location.href = '{{ route('home') }}'">
        </div>
        <div class="d-none d-lg-flex justify-content-center gap-4" id="menuLists">
            <span class="d-flex d-lg-none material-symbols-outlined d-flex justify-content-end" id="closeButton">
                close
                </span>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('menuPage') }}">Menu</a>
            @auth
                <a href="{{ route('cart') }}">Cart</a>
            @endauth 
            <a href="#">About(NOT YET)</a>
            <a href="#">Contact(NOT YET)</a>
            @auth
                <form action="{{route('logoutRequest')}}" method="get">
                    <button class="btn btn-primary" type="submit">Logout</button>
                </form>
            @else
                <button class="btn btn-primary" type="submit" onclick="window.location.href = '{{route('loginPage')}}'">Login</button>
            @endif
        </div>
        <span class="material-symbols-outlined d-flex d-lg-none" id="menuButton">
            menu
            </span>
    </nav>
</div>
