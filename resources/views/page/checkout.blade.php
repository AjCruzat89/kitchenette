    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kitchenette | Checkout</title>
        <!--===============================================================================================-->
        <link rel="shortcut icon" href="{{ asset('./img/castiels.png') }}" type="image/x-icon">
        <!--===============================================================================================-->
        <link rel="stylesheet" href="{{ asset('./css/checkout.css') }}">
        <!--===============================================================================================-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!--===============================================================================================-->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <!--===============================================================================================-->
    </head>

    <body>
        <!--===============================================================================================-->
        <div class="ms-3 mt-3">
            <h1 onclick="window.location.href ='{{ route('cart') }}' "><span class="material-symbols-outlined">
                    arrow_back
                </span>Back</h1>
        </div>
        <!--===============================================================================================-->
        <div class="w-100 text-center mt-3">
            <h2>Order Summary</h2>
        </div>
        <!--===============================================================================================-->
        <div class="d-flex justify-content-center mt-4 w-100">
            <!--===============================================================================================-->
            <form class="d-flex justify-content-center w-100" action="{{ route('placeOrder') }}" method="POST">
                @csrf
                <!--===============================================================================================-->
                <div class="checkoutBox p-2 p-md-3 rounded">
                    <div class="cartBox p-2 p-md-3 rounded">
                        <h2 class="text-center mb-3">Cart Items</h2>
                        @foreach ($items as $item)
                            <input class="d-none" type="text" name="product_id[]" id="" value="{{ $item->product_id }}" readonly>
                            <input class="d-none" type="text" name="quantity[]" id="" value="{{ $item->quantity }}" readonly>
                            <input class="d-none" type="text" name="orders[]" id="" value="{{ $item->product_name }} x {{ $item->quantity }} (₱{{ number_format($item->total) }})" readonly>
                            <input class="d-none" type="text" name="grandTotal" id="" value="{{ $itemsGrandTotal }}" readonly>
                            <h3>{{ $item->product_name }} x {{ $item->quantity }} <span>(₱{{ number_format($item->total) }})</span></h3>
                        @endforeach
                        <h3 class="bg-white p-2 rounded">Grand Total: <span>₱{{ number_format($itemsGrandTotal) }}</span></h3>
                    </div>
                    <h2 class="text-center information p-2 mt-3 rounded">Information</h2>
                    <div class="informationBox">
                        <h3><span class="material-symbols-outlined">
                                person
                            </span>{{ auth()->user()->name }}</h3>
                        <h3 class="text-break"><span class="material-symbols-outlined">
                                mail
                            </span>{{ auth()->user()->email }}</h3>
                        <div class="d-flex flex-row align-items-center gap-1">
                            <span class="material-symbols-outlined">
                                call
                            </span>
                            <input class="rounded p-1 w-100" type="tel" name="phone_number" id=""
                                placeholder="Enter Phone Number..." required maxlength="11" oninput="this.value = this.value.replace(/\D/g, '')">
                        </div>
                        <div class="d-flex flex-row align-items-center gap-1 mt-2">
                            <span class="material-symbols-outlined">
                                location_on
                            </span>
                            <textarea class="w-100 p-1 rounded" name="address" id="" cols="30" rows="2"
                                placeholder="Enter Address..." required maxlength="100"></textarea>
                        </div>

                        <div class="d-flex flex-row align-items-center gap-1 mt-2">
                            <span class="material-symbols-outlined">
                                payments
                            </span>
                            <select name="payment_method" id="" class=" p-1 rounded w-100">
                                <option value="Cash On Delivery">Cash On Delivery(COD)</option>
                            </select>
                        </div>

                        <h5 class="text-center mt-4"
                            style="color: red; font-weight: bold; font-size: 15px; font-style: italic;">NOTE: YOU CAN'T
                            CANCEL ORDERS!!!.</h5>
                        <button type="submit" class="btn btn-danger w-100">Place Order</button>
                    </div>
                </div>
                <!--===============================================================================================-->
            </form>
            <!--===============================================================================================-->
        </div>
        <!--===============================================================================================-->


        <!--===============================================================================================-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <!--===============================================================================================-->
    </body>

    </html>
