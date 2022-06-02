@section('title', 'Select Pixel')
@include('template/header')
<div class="main bg">
    <div class="container">
        <div class="container">
            <h1>Resize Image Uploading Demo</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
               
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h3>Primary Image:</h3>
                    <img src="/images/{{ Session::get('fileName') }}" />
                </div>
                <div class="col-md-4">
                    <h3>Thumbnail:</h3>
                    <img src="/thumbnails/{{ Session::get('fileName') }}" />
                </div>
            </div>
            @endif
               
            <form method="POST" action="{{ route('resizeImagePost') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <br/>
                        <input type="text" name="name" class="form-control" placeholder="Add Title">
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <input type="file" name="imgFile" class="image">
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <button type="submit" class="btn btn-success">Upload Image</button>
                    </div>
                </div>
            </form>
            </div>
    </div>
</div>
@include('template/footer')