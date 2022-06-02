@section('title', 'Home')
@include('template/header')
<div class="main bg">
    <div class="text-center">
        <h1>Reset password</h1>
    </div>
    <div class="container d-flex justify-content-center">
        <form method="POST" action="{{ route('resetPassword') }}" class="col-md-6 mb-3 mt-3 ms-md-3">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" required>
            </div>
            @if(isset($status))
                <div class="alert alert-success mt-3 mb-3" role="alert">Password recovery instructions have been sent to your email</div>
            @endif
            @error('errors')
                <div class="alert alert-danger mt-3 mb-3" role="alert">Email not fount or instructions have already been sent</div>
            @enderror
            <div class="authorization__form-button">
                <button type="submit" class="btn btn-primary">Reset password</button>
            </div>
            <div class="mt-3">
                <a href="/registration" class="text-decoration-none text-center">Not registered yet?</a>
            </div>
            <div class="mt-3">
                <a href="/login" class="text-decoration-none text-center">login</a>
            </div>
        </form>
    </div>
</div>
@include('template/footer')
