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

        @if(count($orders) > 0)
        <div class="table-responsive mt-3 rounded">
            <table class="table">
                <thead class="table-danger">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">phone_number</th>
                        <th scope="col">email</th>
                        <th scope="col">address</th>
                        <th scope="col">orders</th>
                        <th scope="col">grand_total</th>
                        <th scope="col">payment_method</th>
                        <th scope="col">status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->phone_number }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->address }}</td>
                            <td style="white-space: nowrap">{{ $order->orders }}</td>
                            <td>{{ $order->grand_total }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-danger text-center p-5 mb-4" data-aos="fade-up">No Orders Available.</div>
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
        });
    </script>
    <script>
        document.title = 'Kitchenette | Order Status'
    </script>
    @include('component.footer')
