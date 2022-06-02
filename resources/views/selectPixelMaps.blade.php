@section('title', 'Select Pixel')
@include('template/header')
<div class="main">
        <style>
            #block_pointer {
                padding: 0;
                margin: 0;
                font-size: 10px;
            }
        </style>
        <script type="text/javascript">
        function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
        }

            var selectedBlocks = [];
            var selBlocksIndex = 0;
    
            //Begin -J- Edit: Custom functions for resize bug
            //Taken from http://www.quirksmode.org/js/findpos.html; but modified
            function findPosX(obj) {
                var curleft = 0;
                if (obj.offsetParent) {
                    while (obj.offsetParent) {
                        curleft += obj.offsetLeft;
                        obj = obj.offsetParent;
                    }
                } else if (obj.x)
                    curleft += obj.x;
                return curleft;
            }
    
            //Taken from http://www.quirksmode.org/js/findpos.html; but modified
            function findPosY(obj) {
                var curtop = 0;
                if (obj.offsetParent) {
                    while (obj.offsetParent) {
                        curtop += obj.offsetTop;
                        obj = obj.offsetParent;
                    }
                } else if (obj.y)
                    curtop += obj.y;
                return curtop;
            }
    
            var trip_count = 0;
    
            function check_selection(OffsetX, OffsetY) {
    
                // Trip to the database.
                /*var xmlhttp;
    
                if (typeof XMLHttpRequest !== "undefined") {
                    xmlhttp = new XMLHttpRequest();
                }
    
                // Note: do not use &amp; for & here
                xmlhttp.open("GET", "check_selection.php?user_id=1&map_x=" + OffsetX + "&map_y=" + OffsetY + "&block_id=" + get_clicked_block() + "&BID=1&t=1650987387", true);
    
                if (trip_count !== 0) {
                    // trip_count: global variable counts how many times it goes to the server
                    document.getElementById('submit_button1').disabled = true;
                    document.getElementById('submit_button2').disabled = true;
                    window.$block_pointer.css('cursor', 'wait');
                    window.$pixelimg.css('cursor', 'wait');
                }
    
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState === 4) {
    
                        // bad selection - not available
                        if (xmlhttp.responseText.indexOf('E432') > -1) {
                            alert(xmlhttp.responseText);
                            is_moving = true;
    
                        }
    
                        document.getElementById('submit_button1').disabled = false;
                        document.getElementById('submit_button2').disabled = false;
    
                        window.$block_pointer.css('cursor', 'pointer');
                        window.$pixelimg.css('cursor', 'pointer');
    
                    }
    
                };
    
                xmlhttp.send(null);*/
    
            }
    
            function make_selection(event) {
    
                event.stopPropagation();
                event.preventDefault();
    
                window.reserving = true;
    
                window.$block_pointer.css('cursor', 'wait');
                window.$pixelimg.css('cursor', 'wait');
                document.body.style.cursor = 'wait';
                let submit1 = document.getElementById('submit_button1');
                let submit2 = document.getElementById('submit_button2');
                submit1.disabled = true;
                submit2.disabled = true;
                submit1.value = "Please Wait! Reserving Pixels...";
                submit2.value = "Please Wait! Reserving Pixels...";
                submit1.style.cursor = 'wait';
                submit2.style.cursor = 'wait';
    
                let ajax_data = {
                    user_id: 1,
                    map_x: window.$block_pointer.map_x,
                    map_y: window.$block_pointer.map_y,
                    block_id: get_clicked_block(),
                    BID: 1,
                    t: 1650987387			};
    
                $.ajax({
                    method: 'POST',
                    url: 'https://webhook.site/7b576c44-00c3-402d-8cf4-527a10ec1689',
                    data: ajax_data,
                    dataType: 'html',
                    crossDomain: true,
                }).done(function (data) {
                    if (data.indexOf('E432') > -1) {
                        alert(data);
                        window.$block_pointer.css('cursor', 'pointer');
                        window.$pixelimg.css('cursor', 'pointer');
                        document.body.style.cursor = 'pointer';
                        submit1.disabled = false;
                        submit2.disabled = false;
                        submit1.value = "Write Your Ad ->>";
                        submit2.value = "Write Your Ad ->>";
                        submit1.style.cursor = 'pointer';
                        submit2.style.cursor = 'pointer';
                        window.reserving = false;
                        is_moving = true;
                    } else {
                        document.form1.submit();
                    }
    
                }).fail(function (jqXHR, textStatus, errorThrown) {
                }).always(function () {
                });
    
            }
    
            // Initialize
            var block_str = "";
            trip_count = 0;
    
            var pos;
    
            function getObjCoords(obj) {
                var pos = {x: 0, y: 0};
                var curtop = 0;
                var curleft = 0;
                if (obj.offsetParent) {
                    while (obj.offsetParent) {
                        curtop += obj.offsetTop;
                        curleft += obj.offsetLeft;
                        obj = obj.offsetParent;
                    }
                } else if (obj.y) {
                    curtop += obj.y;
                    curleft += obj.x;
                }
                pos.x = curleft;
                pos.y = curtop;
                return pos;
            }
    
            function show_pointer(e) {
                if (!is_moving) return;
    
                var pos = getObjCoords(window.$pixelimg[0]);
    
                if (e.offsetX != undefined) {
                    var OffsetX = e.offsetX;
                    var OffsetY = e.offsetY;
                    $('#submit_button1').css('display', 'none');
                    $('#description_go-to-pay').css('display', 'block');
                    console.log('123');
                } else {
                    var OffsetX = e.pageX - pos.x;
                    var OffsetY = e.pageY - pos.y;
                }
    
                OffsetX = Math.floor(OffsetX / 10) *10;
                OffsetY = Math.floor(OffsetY / 10) *10;
    
                if (isNaN(OffsetX) || isNaN(OffsetY) || OffsetX < 0 || OffsetY < 0) {
                    return;
                }
    
                if (window.pointer_height + OffsetY > 1000) {
                } else {
                    window.$block_pointer.css('top', pos.y + OffsetY + 'px');
                    window.$block_pointer.map_y = OffsetY;
                }
    
                if (window.pointer_width + OffsetX > 1000) {
                } else {
                    window.$block_pointer.map_x = pos.x + OffsetX;
                    window.$block_pointer.css('left', pos.x + OffsetX + 'px');
                }
    
                return true;
            }
    
            var i_count = 0;
    
            function show_pointer2(e) {
                //function called when mouse is over the actual pointing image
    
                if (!is_moving) return;
    
                var pos = getObjCoords(window.$pixelimg[0]);
                var p_pos = getObjCoords(window.$block_pointer[0]);
    
                if (e.offsetX != undefined) {
                    var OffsetX = e.offsetX;
                    var OffsetY = e.offsetY;
                    var ie = true;
                } else {
                    var OffsetX = e.pageX - pos.x;
                    var OffsetY = e.pageY - pos.y;
                    var ie = false;
                }
    
                if (ie) { // special routine for internet explorer...
    
                    var rel_posx = p_pos.x - pos.x;
                    var rel_posy = p_pos.y - pos.y;
    
                    window.$block_pointer.map_x = rel_posx;
                    window.$block_pointer.map_y = rel_posy;
    
                    if (isNaN(OffsetX) || isNaN(OffsetY)) {
                        return
                    }
    
                    if (OffsetX >=10) {
                        // move the pointer right
                        if (rel_posx + window.pointer_width >= 1000) {
                        } else {
                            window.$block_pointer.map_x = p_pos.x +10;
                            window.$block_pointer.css('left', window.$block_pointer.map_x + 'px');
                        }
    
                    }
    
                    if (OffsetY >10) {
                        // move the pointer down
    
                        if (rel_posy + window.pointer_height >= 1000) {
    
                            //return
                        } else {
    
                            window.$block_pointer.map_y = p_pos.y +10;
                            window.$block_pointer.css('top', window.$block_pointer.map_y + 'px');
                        }
                    }
    
                } else {
    
                    var tOffsetX = Math.floor(OffsetX / 10) *10;
                    var tOffsetY = Math.floor(OffsetY / 10) *10;
    
                    if (isNaN(OffsetX) || isNaN(OffsetY)) {
                        //alert ('naan');
                        return
    
                    }
                    if (OffsetX > tOffsetX) {
    
                        if (window.pointer_width + tOffsetX > 1000) {
                            // dont move left
                        } else {
                            window.$block_pointer.map_x = tOffsetX;
                            window.$block_pointer.css('left', pos.x + tOffsetX + 'px');
                        }
    
                    }
    
                    if (OffsetY > tOffsetY) {
    
                        if (window.pointer_height + tOffsetY > 1000) { // dont move down
    
                        } else {
    
                            window.$block_pointer.css('top', pos.y + tOffsetY + 'px');
                            window.$block_pointer.map_y = tOffsetY;
                        }
    
                    }
    
                }
    
            }
    
            function get_clicked_block() {
    
                var grid_width =1000;
                var grid_height =1000;
    
                var blk_width = 10;
                var blk_height = 10;
    
                var clicked_block = ((window.$block_pointer.map_x) / blk_width) + ((window.$block_pointer.map_y / blk_height) * (grid_width / blk_width));
    
                if (clicked_block === 0) {
                    clicked_block = "0";// convert to string
    
                }
                return clicked_block;
            }

            function checkPlace(x, y) {
                console.log('JS-X: '+x +', JS-Y: '+y)
                let ajax_data = {
                    X: x,
                    Y: y,
                    size: {{ $size }}
                };

                var request = $.ajax({
                    url: "/checkPlace",
                    method: "POST",
                    data: ajax_data,
                    success: function(data){
                        if(data == 1) {
                            do_block_click();
                            alert("You can't put a pixel here! Choose a free seat!");
                        }
                    }
                });

            }
    
            function do_block_click() {
    
                if (window.reserving) {
                    return;
                }
    
                trip_count = 1;
                check_selection(window.$block_pointer.map_x, window.$block_pointer.map_y);
                low_x = window.$block_pointer.map_x;
                low_y = window.$block_pointer.map_y;
    
                is_moving = !is_moving;

                $('#submit_button1').css('display', 'block');
                $('#description_go-to-pay').css('display', 'none');
            }
    
            var low_x = 0;
            var low_y = 0;
    
            low_x = 0;low_y = 0;  is_moving=true 
            function move_image_to_selection() {
                let pos = getObjCoords(window.$pixelimg[0]);
                // {x: 20, y: 630}
                window.$block_pointer.css('top', pos.y + low_y + 'px');
                window.$block_pointer.map_y = low_y;
    
                window.$block_pointer.css('left', pos.x + low_x + 'px');
                window.$block_pointer.map_x = low_x;
    
                window.$block_pointer.css('visibility', 'visible');
            }
        </script>
        <span id="block_pointer" style="cursor: pointer; position: absolute; z-index: 999; left: 630px; top: 720px; background: transparent; visibility: visible; width: {{ $size }}px; height: {{ $size }}px; line-height: {{ $size }}px;">
            <img src="{{ asset('/gif/'.$gif_name) }}" alt="" style="width: {{ $size }}px; height: {{ $size }}px;">
        </span>
        <form action="{{ route('OrderPixels') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg pb-4" style="height: 120px;">
                <p><strong>Upload your pixels:</strong></p>
                <p id="description_go-to-pay">To continue, you first need to choose a location for your video image!</p>
                <input type="submit" class="big_button btn btn-primary" name="submit_button1" id="submit_button1" value="GO TO PAY ->>" style="display: block;">
            </div>
            <img style="cursor: pointer; position: absolute;" id="pixelimg" type="image" name="map" value="Select Pixels." width="1000" height="1000" src="{{ asset('/img/main1.png?v1.2') }}" alt="main">
            @if(isset($data))
        @foreach ($data as $el)
        <span style="cursor: pointer; position: relative; left: {{ $el->X }}px; top: {{ $el->Y }}px; background: transparent; visibility: visible;" data-url="{{ asset('/gif/'.$el->url) }}">
            <div style="position: absolute; width: {{ $el->size }}px; height: {{ $el->size }}px; border:1px solid #000; display:flex;justify-content:center;align-items:center;padding:2px;background:#fff;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg></div>
        </span>
        @endforeach
        @endif
            <input id="maps_coords_x" name="maps_coords_x" type="text" value="" hidden>
            <input id="maps_coords_y" name="maps_coords_y" type="text" value="" hidden>
            <input name="gif_name" type="text" value="{{ $gif_name }}" hidden>
            <input name="size" type="text" value="{{ $size }}" hidden>
            <input name="size_order" type="text" value="{{ $size_order }}" hidden>
            <input name="url" type="text" value="{{ $url }}" hidden>
            <input type="hidden" name="action" value="select">
        </form>
        <form method="post" action="write_ad.php" name="form1" style="display: none;">
            <input type="hidden" name="package" value="">
            <input type="hidden" name="selected_pixels" value="">
            <input type="hidden" name="order_id" value="2e2058089fe986088b12c72088383942">
            <input type="hidden" value="1" name="BID">
            <input type="submit" class="big_button" name="submit_button2" id="submit_button2" value="Write Your Ad ->>" onclick="make_selection(event);">
            <hr>
        </form>
        <script type="text/javascript">
            document.form1.selected_pixels.value = block_str;
            $(function () {
                window.pointer_width = <?php echo $size ?>;
                window.pointer_height =  <?php echo $size ?>;
    
                window.$block_pointer = $('#block_pointer');
                window.$pixelimg = $('#pixelimg');
    
                window.onresize = move_image_to_selection;
                window.onload = move_image_to_selection;
                move_image_to_selection();
    
                window.$block_pointer.on('mousemove', function (event) {
                    show_pointer2(event);
                });
    
                window.$block_pointer.on('click', function (event) {
                    do_block_click();
                    checkPlace(window.$block_pointer.map_x, window.$block_pointer.map_y);
                    $('#maps_coords_x').val(window.$block_pointer.map_x);
                    $('#maps_coords_y').val(window.$block_pointer.map_y);
                    console.log(window.$block_pointer.map_y);
                    console.log(window.$block_pointer.map_x);
                });
    
                window.$pixelimg.on('mousemove', function (event) {
                    show_pointer(event);
                });
    
                window.$pixelimg.on('load', function () {
                    remove_ajax_loader();
                });
    
                add_ajax_loader(window.$pixelimg.parent());
            });
            $(document).ready(function(){
                $('form').submit(function(){
                    $(this).find('input[type=submit], button[type=submit]').prop('disabled', true);
                });
            });
        </script>
</div>
@include('template/footer')