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
        <h1>ORDER STATUS</h1>

        @if (count($orders) > 0)
            @foreach ($orders as $order)
                <div class="d-flex flex-column w-100 mt-4 rounded overflow-hidden" id="orderStatus">

                    <div class="d-flex flex-column w-100" id="orderStatusBox">
                        <div class="d-flex flex-row w-100 pt-3 pb-2 ps-2 pe-2" id="orderStatusHeader">
                            <h1><span class="material-symbols-outlined">
                                    expand_more
                                </span>ORDER ID: {{ $order->id }}</h1>
                        </div>

                        <div class="d-none flex-column py-4 px-2" id="orderStatusBody">
                            <p><span class="material-symbols-outlined">
                                    call
                                </span>PHONE NUMBER: {{ $order->phone_number }}</p>
                            <p><span class="material-symbols-outlined">
                                    mail
                                </span>EMAIL: {{ $order->email }}</p>
                            <p><span class="material-symbols-outlined">
                                    location_on
                                </span>ADDRESS: {{ $order->email }}</p>
                            @php
                                $orderItems = explode(',', $order->orders);
                            @endphp
                            <p class="orders"><span class="material-symbols-outlined">
                                    list_alt
                                </span>ORDERS: <br>
                                @foreach ($orderItems as $item)
                                    {{ $item }}
                                    <br>
                                @endforeach
                            </p>
                            <p><span class="material-symbols-outlined">
                                    shopping_cart
                                </span>GRAND TOTAL: ₱{{ $order->grand_total }}</p>
                            <p><span class="material-symbols-outlined">
                                    payments
                                </span>PAYMENT METHOD: {{ $order->payment_method }}</p>
                            @if ($order->status == 'pending')
                                <p><span class="material-symbols-outlined">
                                        check_circle
                                    </span>STATUS: <i
                                        style="color: red; font-weight: bold; text-decoration: none;">PENDING</i></p>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        @else
        <div class="alert alert-danger text-center p-5 mt-4" data-aos="fade-up">No Orders Placed.</div>
        @endif
    </div>
    <!--===============================================================================================-->
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

            const orderStatusBoxes = document.querySelectorAll('#orderStatusBox');

            orderStatusBoxes.forEach(orderStatusBox => {
                const orderStatusHeader = orderStatusBox.querySelector('#orderStatusHeader');

                orderStatusHeader.addEventListener('click', function() {
                    const orderStatusBody = orderStatusBox.querySelector('#orderStatusBody');
                    orderStatusBody.classList.toggle('d-flex');
                    orderStatusBody.classList.toggle('d-none');
                });
            });
        });
    </script>
    <!--===============================================================================================-->
    <script>
        document.title = 'Kitchenette | Order Status'
    </script>
    <!--===============================================================================================-->
    @include('component.footer')
