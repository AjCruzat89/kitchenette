@include('component.formheader')
<form action="{{ route('loginRequest') }}" method="POST">
    @csrf
    <div class="vh-100 d-flex justify-content-center align-items-center w-100">


        <div class="box d-flex flex-column p-4 p-lg-5" data-aos="fade-up">
            <h1>Login</h1>
            @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif
            @error('email')
                <div class="alert alert-danger text-center">{{ $message }}</div>
            @enderror
            @error('password')
                <div class="alert alert-danger text-center">{{ $message }}</div>
            @enderror
            <label for="" class="mt-3">Email</label>
            <input type="text" name="email" id="" placeholder="Enter Username...">
            <label for="" class="mt-3">Password</label>
            <input type="password" name="password" id="" placeholder="Enter Password...">
            <a href="{{ route('registerPage') }}" class="mt-3">Don't Have An Account? Register here...</a>
            <a href="{{ route('forgotPassword') }}">Forgot Password?</a>
            <button class="btn btn-primary mt-4" type="submit">Login</button>
        </div>

    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ("{{ session('success') }}") {
            Swal.fire({
                icon: 'success',
                title: '{{session('success')}}',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
</script>
<script>
    document.title = 'Kitchenette | Login'
</script>
@include('component.formfooter')
