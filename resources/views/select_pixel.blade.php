@section('title', 'Select Pixel')
@include('template/header')
<div class="main bg">
    <div class="container">
        <h1 class="text-center">Buy Pixel</h1>
        <p><strong>Upload your GIF</strong></p>
        <p>- Click 'Browse' to find your file on your computer, then click 'Upload'.</p>
        <p>- Once uploaded, you will be able to position your file over the grid.</p>
        <p>– The GIF must be a maximum of 1 megabyte</p>
        <p><strong>Upload your pixels:</strong></p>
        <form action="{{ route('resizeImagePost') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="tiktok_url" class="form-label">Write your TikTok username</label>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="url" id="url" placeholder="Example: @bellapoarch" aria-describedby="tiktok_url">
                <small id="emailHelp" class="form-text text-muted">People will automatically go to your profile</small>
            </div>
            <label for="url" class="form-label">Pixels</label>
            <div class="mb-3 row">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                  
                    <input type="radio" class="btn-check" name="pixels" id="100px" value="100" autocomplete="off">
                    <label class="btn btn-outline-primary" for="100px">100px</label>
                  
                    <input type="radio" class="btn-check" name="pixels" id="400px" value="400" autocomplete="off">
                    <label class="btn btn-outline-primary" for="400px">400px</label>

                    <input type="radio" class="btn-check" name="pixels" id="900px" value="900" autocomplete="off">
                    <label class="btn btn-outline-primary" for="900px">900px</label>

                    <input type="radio" class="btn-check" name="pixels" id="1600px" value="1600" autocomplete="off">
                    <label class="btn btn-outline-primary" for="1600px">1600px</label>

                    <input type="radio" class="btn-check" name="pixels" id="2500px" value="2500" autocomplete="off">
                    <label class="btn btn-outline-primary" for="2500px">2500px</label>

                </div>
                <div class="btn-group mt-3" role="group" aria-label="Basic radio toggle button group">

                    <input type="radio" class="btn-check" name="pixels" id="3600px" value="3600" autocomplete="off">
                    <label class="btn btn-outline-primary" for="3600px">3600px</label>

                    <input type="radio" class="btn-check" name="pixels" id="4900px" value="4900" autocomplete="off">
                    <label class="btn btn-outline-primary" for="4900px">4900px</label>

                    <input type="radio" class="btn-check" name="pixels" id="8100px" value="8100" autocomplete="off">
                    <label class="btn btn-outline-primary" for="8100px">8100px</label>

                    <input type="radio" class="btn-check" name="pixels" id="10000px" value="10000" autocomplete="off">
                    <label class="btn btn-outline-primary" for="10000px">10000px</label>
                </div>
            </div>
            <div class="input-group mb-3 row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <input hidden type="number" name="width_order" class="pixels__value" value="1">
                <input hidden type="number" name="width" class="pixels__value_size_grid" value="1">
                <input type="number" class="pixels__value form-control" placeholder="Height" aria-label="Height" value="1" hidden disabled>
                <input hidden name="height_order" type="number" class="pixels__value" value="1">
                <input hidden name="height" type="number" class="pixels__value_size_grid" value="1">
            </div>
            <div class="mb-3 mt-3">
                <label for="gif">GIF</label>
            </div>
            <div class="mb-3">
                <label for="gif" class="gif-upload form-label btn btn-success">Choose file <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#fff" d="M144 480C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144zM223 263C213.7 272.4 213.7 287.6 223 296.1C232.4 306.3 247.6 306.3 256.1 296.1L296 257.9V392C296 405.3 306.7 416 320 416C333.3 416 344 405.3 344 392V257.9L383 296.1C392.4 306.3 407.6 306.3 416.1 296.1C426.3 287.6 426.3 272.4 416.1 263L336.1 183C327.6 173.7 312.4 173.7 303 183L223 263z"/></svg>
                    <input name="gif" class="form-control form-control-sm filestyle1" id="gif" type="file" required>
                </label>
                <span class="name-file-upload">

                </span>
                <script>
                    $(document).ready(function(){
                        $('input[type="file"]').change(function(e){
                            var fileName = e.target.files[0].name;
                            $('.name-file-upload').text(fileName);
                        });
                    });
                </script>
            </div>
            <style>
                .filestyle1 {
                    display: none;
                }
                .gif-upload svg {
                    width: 20px;
                    height: 20px;
                }
            </style>
            <input type="hidden" name="BID" value="1">
            <input class="mds_upload_image btn btn-primary" type="submit" value="Upload">
        </form>
        <script>
            $(document).ready(function(){
                $('form').submit(function(){
                    $(this).find('input[type=submit], button[type=submit]').prop('disabled', true);
                });


                $('#gif').bind('change', function() {

                var size = this.files[0].size; // размер в байтах
                var name = this.files[0].name;

                if(1000000<size){

                    alert('File cannot be larger than 1 megabyte');

                }

                var fileExtension = ['gif']; // допустимые типы файлов
                if ($.inArray(name.split('.').pop().toLowerCase(), fileExtension) == -1) {

                // у файла неверный тип
                alert('Valid File Format – GIF');

                }

                });


            });
        </script>
    </div>
</div>
@include('template/footer')