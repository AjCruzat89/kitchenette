@include('component.formheader')
<form action="{{ route('resetPasswordRequest', ['token' => $token]) }}" method="POST">
    @csrf
    <div class="vh-100 d-flex justify-content-center align-items-center w-100">

        <div class="box d-flex flex-column p-4 p-lg-5" data-aos="fade-up">
            <h1>Reset Password</h1>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @error('password')
                <div class="alert alert-danger text-center">{{ $message }}</div>
            @enderror
            @error('password_confirmation')
                <div class="alert alert-danger text-center">{{ $message }}</div>
            @enderror
            <label for="" class="mt-3">New Password</label>
            <input type="password" name="password" id="" placeholder="Enter Password...">
            <label for="" class="mt-3">Re-Enter New Password</label>
            <input type="password" name="password_confirmation" id="" placeholder="Enter Password...">
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
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1000
            });
        setTimeout(() => {
            window.location.href = '{{route('loginPage')}}'
        }, 1000);
        }
    });
</script>
<script>
    document.title = 'Kitchenette | Reset Password'
</script>
@include('component.formfooter')
