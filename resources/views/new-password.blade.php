@section('title', 'Home')
@include('template/header')
<div class="main bg">
    <div class="text-center">
        <h1>New password</h1>
    </div>
    <div class="container d-flex justify-content-center">
        <form method="POST" action="{{ route('password.update') }}" class="col-md-6 mb-3 mt-3 ms-md-3">
            @csrf
            <div class="mb-3">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New password</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                    <input name="token" type="text" class="form-control" id="token" value="{{ $token }}" hidden required>
                </div>
            </div>
            <div class="authorization__form-button">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            @error('error')
                <div class="alert alert-danger mt-3 mb-3">Password incorrect</div>
            @enderror
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