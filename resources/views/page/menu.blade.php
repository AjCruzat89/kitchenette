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
        <h1>FOOD MENU</h1>
    </div>

    @if (count($products) > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 mb-4">
            @foreach ($products as $product)
                <div class="col" data-aos="fade-up">
                    <form action="{{ route('addToCart') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column rounded overflow-hidden" id="bodyContentBox">
                            <img class="img-fluid" src="{{ $product->product_pictureURL }}"
                                alt="">
                            <div class="d-flex flex-column p-2">
                                <input class="d-none" type="number" name="product_id" id=""
                                    value="{{ $product->id }}" readonly>
                                <h1>{{ $product->product_name }}</h1>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2>Price: ₱{{ number_format($product->product_price) }}</h2>
                                    <input type="number" name="quantity" id="" value="1" min="0"
                                        max="99" pattern="\d{1,2}" maxlength="2"
                                        onInput="this.value = this.value.slice(0, 2)" style="height:30px;">
                                </div>

                            </div>
                            <button type="submit" class="p-3">Add To Cart</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger text-center p-5 mb-4" data-aos="fade-up">No Products Available.</div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ("{{ session('success') }}") {
            Swal.fire({
                icon: 'success',
                title: '{{session('success')}}',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1000
            });
        }
    });

    @if (session('error'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: '{{ session('error')}}',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 2000,
            });
        });
    @endif
</script>
<script>
    document.title = 'Kitchenette | Menu'
</script>
@include('component.footer')
