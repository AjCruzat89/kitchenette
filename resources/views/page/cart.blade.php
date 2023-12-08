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
    <div class="d-flex flex-column my-4" data-aos="fade-up">
        <h1>MY CART</h1>

        @if (count($carts) > 0)
            <div class="d-flex flex-row mt-4">
                <button class="p-2" id="deleteAll">Delete All</button>
            </div>
            <div class="table-responsive mt-3 rounded">
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                <table class="table table-hover">
                    <thead class="table-danger">
                        <tr>
                            <th>Select</th>
                            <th scope="col">product_name</th>
                            <th scope="col">product_picture</th>
                            <th scope="col">product_price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr class="cart-row">
                                <td>
                                    <div class="">
                                        <input type="checkbox" name="checkbox[]" value="{{ $cart->product_id }}" class="cart-checkbox" data-total="{{ $cart->total }}">
                                    </div>
                                </td>
                                <td>{{ $cart->product_name }}</td>
                                <td><img class="img-fluid rounded"
                                        style="width: 150px; height: 150px; object-fit: cover;"
                                        src="{{ $cart->product_pictureURL }}" alt=""></td>
                                <td class="product-price">₱{{ number_format($cart->product_price) }}</td>
                                <td class="quantity">{{ $cart->quantity }}</td>
                                <td class="total">{{ $cart->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-secondary" id="checkoutRow" style="display: none;">
                            <td><button type="submit" class="btn btn-primary" style="white-space: nowrap;">Proceed To Checkout</button></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-flex justify-content-end" style="white-space: nowrap;">Grand Total:</div>
                            </td>
                            <td id="cartGrandTotal"></td>
                        </tr>
                    </tfoot>
                </table>
                </form>
            </div>
        @else
            <div class="alert alert-danger text-center p-5 mt-4" data-aos="fade-up">No Products On Cart.</div>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ("{{ session('success') }}") {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }

            const checkboxes = document.querySelectorAll('.cart-checkbox');
            const checkoutRow = document.getElementById('checkoutRow');
            const cartGrandTotalElement = document.getElementById('cartGrandTotal');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedCheckboxes = document.querySelectorAll('.cart-checkbox:checked');
                    let cartGrandTotal = 0;

                    checkedCheckboxes.forEach(checkedCheckbox => {
                        const totalValue = parseFloat(checkedCheckbox.getAttribute(
                            'data-total'));
                        cartGrandTotal += totalValue;
                    });

                    cartGrandTotalElement.textContent = ` ₱${cartGrandTotal.toFixed(2)}`;
                    checkoutRow.style.display = checkedCheckboxes.length > 0 ? 'table-row' : 'none';
                });
            });
        });
    </script>
    <script>
        document.title = 'Kitchenette | Cart'
    </script>
    @include('component.footer')
