@include('component.adminheader')
<div class="d-flex flex-row w-100">
    @include('component.adminsidebar')
    <div class="d-flex flex-grow-1 flex-column" id="main">
        @include('component.adminnavbar')
        <div class="d-flex flex-column px-3 py-3" id="mainContent">
            <h1>Cards</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3" id="cards">
                <div class="col">
                    <div class="d-flex flex-column p-3">
                        <h1>Total Sales</h1>
                        <h3>1231233</h3>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column p-3">
                        <h1>Total Sales</h1>
                        <h3>1231233</h3>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column p-3">
                        <h1>Total Sales</h1>
                        <h3>1231233</h3>
                    </div>
                </div>
            </div>
            <h1 class="mt-3">Sales</h1>
            <div>
                <canvas id="dailySalesChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (auth()->check())
            if ("{{ session('success') }}") {
                Swal.fire({
                    icon: 'success',
                    title: 'Hi {{ auth()->user()->name }}',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        @endif
    });
</script>
<script>document.title = 'Kitchenette | Admin'</script>
@include('component.adminfooter')
