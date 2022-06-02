@section('title', 'Home')
@include('template/header')
<div class="main bg">
    <div class="text-center pt-3">
        @if(isset($success_email))
        <h1>Email confirmed!</h1>
        <script>
        window.setTimeout( function(){
                 window.location = "/selectpixel";
             }, 2200 );
        </script>
        @else
        <h1>Need to verify email</h1>
        @endif
    </div>
    @if(!isset($success_email))
    <div class="container d-flex justify-content-center">
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Resend email</button>
        </form>
    </div>
    @endif
    @if (\Session::has('message'))
    <div class="container d-flex justify-content-center mt-3">
        <div class="alert alert-success">
            <ul>
                <li>Verification link sent!</li>
            </ul>
        </div>

    </div>
    @endif
</div>
@include('template/footer')
