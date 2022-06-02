@section('title', 'Home')
@include('template/header')
<div class="main bg">
    <div class="text-center">
        <h1>Registration</h1>
    </div>
    <div class="container d-flex justify-content-center">
        <form method="POST" action="{{ route('user.registration') }}" class="col-md-6 mb-3 mt-3 ms-md-3">
            @csrf
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input name="name" type="text" class="form-control" id="fullname" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input name="phone" type="tel" class="form-control" id="phone" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            @error('email')
            <div class="alert alert-danger mt-3 mb-3">Email already taken</div>
            @enderror
            <div class="authorization__form-button">
                <button type="submit" class="btn btn-primary">Registration</button>
            </div>
            <div class="mt-3">
                <a href="/login" class="text-decoration-none text-center">Login</a>
            </div>
        </form>
    </div>
</div>
@include('template/footer')
