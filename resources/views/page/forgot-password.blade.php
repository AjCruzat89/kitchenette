@include('component.formheader')
<form action="{{ route('forgotPasswordRequest') }}" method="POST">
    @csrf
    <div class="vh-100 d-flex justify-content-center align-items-center w-100">
        
        <div class="box d-flex flex-column p-4 p-lg-5" data-aos="fade-up">
            <h1>Forget Password</h1>
            @error('email')
                <div class="alert alert-danger text-center">{{ $message }}</div>
            @enderror
            <label for="" class="mt-3">Email</label>
            <input type="text" name="email" id="" placeholder="Enter Email...">
            <a href="{{ route('loginPage') }}" class="mt-3">Want To Go Back? Click Here...</a>
            <button class="btn btn-primary mt-4" type="submit">Submit</button>
        </div>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ("{{ session('success') }}") {
            Swal.fire({
                icon: 'success',
                title: 'Email Sent!',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
</script>
<script>document.title = 'Kitchenette | Forgot Password'</script>
@include('component.formfooter')
