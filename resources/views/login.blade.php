@section('title', 'Home')
@include('template/header')
<div class="main bg">
    <div class="text-center">
        <h1>Login</h1>
    </div>
    <div class="container d-flex justify-content-center">
        <form method="POST" action="{{ route('user.login') }}" class="col-md-6 mb-3 mt-3 ms-md-3">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            @error('email')
            <div class="alert alert-danger mb-3 mt-3" role="alert">Email incorrect</div>
            @enderror
            <div class="authorization__form-button">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            @error('error')
                <div class="alert alert-danger mt-3 mb-3" role="alert">Email or password incorrect</div>
            @enderror
            <div class="mt-3">
                <a href="/registration" class="text-decoration-none text-center">Not registered yet?</a>
            </div>
            <div class="mt-3">
                <a href="{{ route('password.request') }}" class="text-decoration-none text-center">Forgot your password?</a>
            </div>
        </form>
    </div>
</div>
@include('template/footer')