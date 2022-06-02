@section('title', 'Home')
@include('template/header') 
<div class = "main" >
    <form action="{{ route('getPaymendLink') }}" method="POST">
        @csrf
        <button class="btn btn-primary" type="submit">Pay</button>
    </form>
</div>
@include('template/footer')