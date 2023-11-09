@include('component.adminheader')
<div class="d-flex flex-row w-100">
    @include('component.adminsidebar')
    <div class="d-flex flex-grow-1 flex-column" id="main">
        @include('component.adminnavbar')
        <!--===============================================================================================-->
        <div class="d-flex flex-column px-3 py-3" id="mainContent">
            <h1>Products</h1>
            <div class="d-flex flex-row">
                <button data-bs-toggle="modal" data-bs-target="#addInventory"><span class="material-symbols-outlined">
                        add_circle
                    </span>ADD</button>
            </div>
            <!--===============================================================================================-->
            <div class="table-responsive mt-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">product_id</th>
                            <th scope="col">product_name</th>
                            <th scope="col">product_picture</th>
                            <th scope="col">product_price</th>
                            <th scope="col">product_stock</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) === 0)
                            <tr>
                                <td colspan="5">No available data</td>
                            </tr>
                        @else
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="col">{{ $product->product_id }}</th>
                                    <td>{{ $product->product_name }}</td>
                                    <td><img class="rounded" src="{{ $product->product_pictureURL }}" alt=""
                                            style="width: 150px; height: 150px; cursor: pointer; object-fit: cover;"
                                            onclick="window.open('{{ $product->product_pictureURL }}' , '_blank')"></td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>{{ $product->product_stock }}</td>
                                    <td>
                                        <div class="d-flex flex-row gap-2">
                                            <span onclick="editModalData(this)" style="--var-color: lightblue;" data-bs-toggle="modal"
                                                data-bs-target="#editInventory" data-id="{{$product->product_id}}" data-pictureURL="{{ $product->product_pictureURL }}" data-product_name="{{$product->product_name}}" data-product_price="{{$product->product_price}}" data-product_stock="{{ $product->product_stock }}" class="material-symbols-outlined">
                                                edit
                                            </span>
                                            <span style="--var-color: red;" class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <!--===============================================================================================-->
                <div class="d-flex justify-content-start">
                    {{ $products->links('vendor.pagination.custom') }}
                </div>
                <!--===============================================================================================-->
            </div>
            <!--===============================================================================================-->
        </div>
        <!--===============================================================================================-->
    </div>
</div>
<!--===============================================================================================-->
<form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="addInventory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><span class="material-symbols-outlined">
                            inventory_2
                        </span>Add Inventory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column gap-2">
                        @error('product_name')
                            <div class="alert alert-danger d-flex align-items-center">{{ $message }}</div>
                        @enderror
                        @error('product_picture')
                            <div class="alert alert-danger d-flex align-items-center">{{ $message }}</div>
                        @enderror
                        @error('product_price')
                            <div class="alert alert-danger d-flex align-items-center">{{ $message }}</div>
                        @enderror
                        @error('product_stocks')
                            <div class="alert alert-danger d-flex align-items-center">{{ $message }}</div>
                        @enderror
                        <div class="d-flex justify-content-center">
                            <img id="productImage" src="#" alt="Product Image" style="display: none;" />
                        </div>
                        <label for="">Product Name</label>
                        <input class="p-2" type="text" name="product_name" id=""
                            placeholder="Enter Product Name...">
                        <label for="">Product Picture</label>
                        <input type="file" name="product_picture" id="" onchange="displayImage(event)"
                            accept="image/*" capture="environment">
                        <label for="">Product Price</label>
                        <input class="p-2" type="text" name="product_price" id=""
                            placeholder="Enter Product Price...">
                        <label for="">Product Stock</label>
                        <input class="p-2" type="text" name="product_stock" id=""
                            placeholder="Enter Product Stock...">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--===============================================================================================-->
<div class="modal fade" id="editInventory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><span class="material-symbols-outlined">
                        inventory_2
                    </span>Edit Inventory</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column gap-2">
                    @error('product_name')
                        <div class="alert alert-danger d-flex align-items-center">{{ $message }}</div>
                    @enderror
                    @error('product_picture')
                        <div class="alert alert-danger d-flex align-items-center">{{ $message }}</div>
                    @enderror
                    @error('product_price')
                        <div class="alert alert-danger d-flex align-items-center">{{ $message }}</div>
                    @enderror
                    @error('product_stocks')
                        <div class="alert alert-danger d-flex align-items-center">{{ $message }}</div>
                    @enderror
                    <div class="d-flex justify-content-center">
                        <img id="productEditImage" src="#" alt="Product Image" style="display: none;" />
                    </div>
                    <label for="">ID</label>
                    <input class="p-2" type="text" name="product_id" id="editProductId" readonly>
                    <label for="">Product Name</label>
                    <input class="p-2" type="text" name="product_name" id="editProductName"
                        placeholder="Enter Product Name...">
                    <label for="">Product Picture</label>
                    <input type="file" name="product_picture" id="" onchange="displayEditImage(event)"
                        accept="image/*" capture="environment">
                    <label for="">Product Price</label>
                    <input class="p-2" type="text" name="product_price" id="editProductPrice"
                        placeholder="Enter Product Price...">
                    <label for="">Product Stock</label>
                    <input class="p-2" type="text" name="product_stock" id="editProductStock"
                        placeholder="Enter Product Stock...">
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--===============================================================================================-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (auth()->check())
            if ("{{ session('success') }}") {
                Swal.fire({
                    icon: 'success',
                    title: 'Product Added Successfully!',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        @endif
    });
</script>
<script>
    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 2000,
            });
        });
    @endif
</script>
<script>
    function displayImage(event) {
        var image = document.getElementById('productImage');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.display = 'block';
    }

    function displayEditImage(event){
        var editImage = document.getElementById('productEditImage');
        editImage.src = URL.createObjectURL(event.target.files[0]);
        editImage.style.display = 'block';
    }

    function editModalData(element) {
    const productId = element.getAttribute('data-id');
    const pictureURL = element.getAttribute('data-pictureURL');
    const productName = element.getAttribute('data-product_name');
    const productPrice = element.getAttribute('data-product_price');
    const productStock = element.getAttribute('data-product_stock');
    var editImage = document.getElementById('productEditImage');
    
    editImage.style.display = 'block';
    editImage.src = pictureURL;
    document.getElementById('editProductId').value = productId;
    document.getElementById('editProductName').value = productName;
    document.getElementById('editProductPrice').value = productPrice;
    document.getElementById('editProductStock').value = productStock;
}

</script>
<script>
    document.title = 'Kitchenette | Products'
</script>
@include('component.adminfooter')
