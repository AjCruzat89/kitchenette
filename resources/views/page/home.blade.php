@include('component.header')
@include('component.navbar')
<!--===============================================================================================-->
<div class="vh-100 d-flex flex-column justify-content-center " id="hero">
    <div class="container">
        <div class="d-flex flex-column flex-md-row mb-5">
            <div class="col">
                <div class="d-flex flex-column h-100 justify-content-center" id="heroBox1" data-aos="fade-right">
                    <h1 style="color: black;">CASTIEL'S</h1>
                    <h1 style="color: #B42730;">KITCHENETTE</h1>
                    <a href="#">About us</a>
                </div>
            </div>
            <div class="col">
                <div class="d-none d-md-flex flex-column" id="heroBox2" data-aos="fade-left">
                    <img class="img-fluid" src="./img/background.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--===============================================================================================-->
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3" id="infoBoxes">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column p-3" id="infoBox"
                data-aos="fade-up">
                <span class="material-symbols-outlined">
                    location_on
                </span>
                <h1 class="mt-3">Location</h1>
                <h2>Lipa City</h2>
            </div>
        </div>
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column p-3" id="infoBox"
                data-aos="fade-up">
                <span class="material-symbols-outlined">
                    schedule
                </span>
                <h1 class="mt-3">Schedule</h1>
                <h2>6:00 AM - 6:00 PM</h2>
            </div>
        </div>
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column p-3" id="infoBox"
                data-aos="fade-up">
                <span class="material-symbols-outlined">
                    call
                </span>
                <h1 class="mt-3">Phone Number</h1>
                <h2>0993 738 0890</h2>
            </div>
        </div>
    </div>
</div>
<!--===============================================================================================-->
<div class="container" id="bodyContent">
    <div class="d-flex my-4" data-aos="fade-up">
        <h1>BEST DEALS</h1>
    </div>

    @if (count($products) > 0)
        <button class="mb-4 p-2" data-aos="fade-up" id="viewAll"
            onclick="window.location.href = '{{ route('menuPage') }}' ">View All</button>

        <div class="swiper mb-4" data-aos="fade-up">
            <div class="swiper-wrapper">
                @foreach ($products as $product)
                    <div class="swiper-slide">
                        <div class="d-flex flex-column">
                            <img class="img-fluid" src="{{ $product->product_pictureURL }}" alt="">
                            <div class="d-flex flex-column p-2" id="swiperDetails">
                                <h1>{{ $product->product_name }}</h1>
                                <h2>Price: ₱{{ number_format($product->product_price) }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center gap-2 mb-4" id="swiperControls">
            <i class="bi bi-caret-left-fill"></i>
            <i class="bi bi-caret-right-fill"></i>
        </div>
    @else
        <div class="alert alert-danger text-center p-5 mb-4" data-aos="fade-up">No Products Available.</div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (auth()->check())
            if ("{{ session('success') }}") {
                Swal.fire({
                    icon: 'success',
                    title: 'Hi! {{ auth()->user()->name }}.',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        @endif
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{session('success')}}',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1000
            });
        @endif
    });
</script>
<script>
    document.title = 'Kitchenette | Home'
</script>
@include('component.footer')
