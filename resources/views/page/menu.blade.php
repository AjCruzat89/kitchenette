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
                    <form action="{{ route('addToCart') }}" method="POST" class="addToCartForm">
                        @csrf
                        <div class="d-flex flex-column rounded overflow-hidden" id="bodyContentBox">
                            @if ($product->product_stock == 0)
                            <img class="soldOut img-fluid" src="{{ asset('./img/sold-out.png') }}">
                            <div class="plainBackground"></div>
                            @endif
                            <img class="img-fluid" src="{{ $product->product_pictureURL }}" alt="">
                            <div class="d-flex flex-column p-2">
                                <input class="d-none" type="number" name="product_id" value="{{ $product->id }}"
                                    readonly>
                                <h1>{{ $product->product_name }}</h1>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2>Price: ₱{{ number_format($product->product_price) }}</h2>
                                    <input type="number" name="quantity" value="0" min="0" max="99" inputmode="numeric"
                                        pattern="\d{1,2}" style="height:30px;">
                                </div>
                            </div>
                            @if ($product->product_stock == 0)
                            <button type="button" class="p-3 addToCartBtn notAvailable">Not Available</button>
                            @else
                            <button type="submit" class="p-3 addToCartBtn">Add To Cart</button>
                            @endif
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
    document.querySelectorAll('.addToCartBtn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var form = this.closest('form');
            var formData = new FormData(form);

            fetch(form.action, {
                    method: form.method,
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: data.success,
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: data.error,
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    }
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        });
    });
</script>
<script>
    document.title = 'Kitchenette | Menu';
</script>
@include('component.footer')
