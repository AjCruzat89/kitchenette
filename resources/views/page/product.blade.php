@include('component.adminheader')
<div class="d-flex flex-row w-100">
    @include('component.adminsidebar')
    <div class="d-flex flex-grow-1 flex-column" id="main">
        @include('component.adminnavbar')
        <div class="d-flex flex-column px-3 py-3" id="mainContent">
            <h1>Products</h1>
            <div class="d-flex flex-row">
                <button data-bs-toggle="modal" data-bs-target="#addInventory"><span class="material-symbols-outlined">
                        add_circle
                    </span>ADD</button>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('addProduct') }}" method="POST">
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
                            <div class="alert alert-danger d-flex align-items-center"><span
                                    class="material-symbols-outlined">
                                    close
                                </span>{{ $message }}</div>
                        @enderror
                        @error('product_picture')
                            <div class="alert alert-danger d-flex align-items-center"><span
                                    class="material-symbols-outlined">
                                    close
                                </span>{{ $message }}</div>
                        @enderror
                        @error('product_price')
                            <div class="alert alert-danger d-flex align-items-center"><span
                                    class="material-symbols-outlined">
                                    close
                                </span>{{ $message }}</div>
                        @enderror
                        @error('product_stocks')
                            <div class="alert alert-danger d-flex align-items-center"><span
                                    class="material-symbols-outlined">
                                    close
                                </span>{{ $message }}</div>
                        @enderror
                        <div class="d-flex justify-content-center">
                            <img id="productImage" src="#" alt="Product Image" style="display: none;" />
                        </div>
                        <label for="">Product Name</label>
                        <input class="p-2" type="text" name="product_name" id=""
                            placeholder="Enter Product Name...">
                        <label for="">Product Picture</label>
                        <input type="file" name="product_picture" id="" onchange="displayImage(event)"
                            accept=".jpg, .jpeg, .png">
                        <label for="">Product Price</label>
                        <input class="p-2" type="text" name="product_price" id=""
                            placeholder="Enter Product Name...">
                        <label for="">Product Stocks</label>
                        <input class="p-2" type="text" name="product_stocks" id=""
                            placeholder="Enter Product Name...">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(auth()->check())
            if ("{{ session('success') }}") {
                Swal.fire({
                    icon: 'success',
                    title: 'Product Added',
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
</script>
<script>
    document.title = 'Kitchenette | Products'
</script>
@include('component.adminfooter')
