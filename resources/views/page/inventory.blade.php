@include('component.adminheader')
<div class="d-flex flex-row w-100">
    @include('component.adminsidebar')
    <div class="d-flex flex-grow-1 flex-column" id="main">
        @include('component.adminnavbar')
        <div class="d-flex flex-column px-3 py-3" id="mainContent">
            <h1>Inventory</h1>
            <div class="d-flex flex-row">
                <button data-bs-toggle="modal" data-bs-target="#addInventory"><span class="material-symbols-outlined">
                        add_circle
                    </span>ADD</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
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
                    <label for="">Product Name</label>
                    <input class="p-2" type="text" name="" id="" placeholder="Enter Product Name...">
                    <label for="">Product Price</label>
                    <input class="p-2" type="text" name="" id="" placeholder="Enter Product Name...">
                    <label for="">Product Stocks</label>
                    <input class="p-2" type="text" name="" id="" placeholder="Enter Product Name...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.title = 'Kitchenette | Inventory'
</script>
@include('component.adminfooter')
