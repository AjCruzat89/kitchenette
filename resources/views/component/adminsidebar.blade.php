<div class="d-none d-md-flex flex-column p-3 gap-3 position-fixed" id="sidebar">
    <div class="d-flex justify-content-center" id="imgBox">
        <i class="d-none bi bi-x-lg"></i>
        <img src="{{ asset('./img/castiels.png') }}" alt="" style="cursor: pointer"
            onclick="window.location.href = '{{ route('admin') }}'">
    </div>
    <a class="mt-4" href="{{ route('admin') }}"><span class="material-symbols-outlined">
            home
        </span>Home</a>
    <a href=""><span class="material-symbols-outlined">
        person
        </span>Users</a>
    <a href="#"><span class="material-symbols-outlined">
            point_of_sale
        </span>Sales</a>
    <a href="{{ route('product') }}"><span class="material-symbols-outlined">
            inventory_2
        </span>Products</a>
    <a href="#"><span class="material-symbols-outlined">
            attach_money
        </span>Expenses</a>
    <a href="#"><span class="material-symbols-outlined">
            report
        </span>Reports</a>
    <a href="#"><span class="material-symbols-outlined">
            settings
        </span>Settings</a>
    <a href="{{route('activity')}}"><span class="material-symbols-outlined">
            menu_book
        </span>Activity Log</a>
    <form action="{{ route('logoutRequest') }}" method="get">
        <button class="btn btn-primary" type="submit"><span class="material-symbols-outlined">
                logout
            </span></button>
    </form>
</div>
