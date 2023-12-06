@include('component.formheader')
<form action="{{ route('registerRequest') }}" method="POST">
    @csrf
    <div class="vh-100 d-flex justify-content-center align-items-center w-100">


        <div class="box d-flex flex-column p-4 p-lg-5" data-aos="fade-up">
            <h1>Register</h1>
            @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center">{{ session('error') }}</div>
            @endif
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger d-flex align-items-center">{{ $error }}</div>
            @endforeach
            <label for="" class="mt-3">Email</label>
            <input type="text" name="email" id="" placeholder="Enter Email...">
            <label for="" class="mt-3">Username</label>
            <input type="text" name="name" id="" placeholder="Enter Username...">
            <label for="" class="mt-3">Password</label>
            <input type="password" name="password" id="" placeholder="Enter Password...">
            <a href="{{ route('loginPage') }}" class="mt-3">Already Have An Account? Login here...</a>
            <button class="btn btn-primary mt-4" type="submit">Register</button>
        </div>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ("{{ session('success') }}") {
            Swal.fire({
                icon: 'success',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
</script>
<script>
    document.title = 'Kitchenette | Register'
</script>
@include('component.formfooter')
