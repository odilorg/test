@section('title', 'Home')
@include('template.header')

<div class = "main" >
    <div class="grid-inner" id="grid1" style="width: 1000px; height: 1000px; position: relative; overflow: hidden; border-bottom: 1px solid rgb(212, 214, 212);">
        <map name="main" id="main">
            <!--<area href="https://google.com" data-data="{&quot;id&quot;:4,&quot;block_id&quot;:0,&quot;banner_id&quot;:1,&quot;alt_text&quot;:&quot;gdsdsg<img src=https:\/\/iris.sofard.gq\/images\/periods.gif border=0>&quot;,&quot;url&quot;:&quot;https:\/\/google.com&quot;}" coords="0, 30, 10, 40" aria-expanded="false" data-coords="50,50,90,60">
            <area href="#" data-bs-toggle="modal"
            data-bs-target="#s1" data-data="{&quot;id&quot;:1,&quot;block_id&quot;:508,&quot;banner_id&quot;:1,&quot;alt_text&quot;:&quot;ewteqt<img src=https:\/\/iris.sofard.gq\/images\/periods.gif border=0>&quot;,&quot;url&quot;:&quot;httpa:\/\/google.com&quot;}" coords="80.24,50.150000000000006,90.27,60.18" aria-expanded="false" data-coords="80,50,90,60">
            <area href="#" data-bs-toggle="modal"
            data-bs-target="#s2" data-data="{&quot;id&quot;:3,&quot;block_id&quot;:916,&quot;banner_id&quot;:1,&quot;alt_text&quot;:&quot;srsaf<img src=https:\/\/iris.sofard.gq\/images\/periods.gif border=0>&quot;,&quot;url&quot;:&quot;https:\/\/google.com&quot;}" coords="160.48,90.27,170.51000000000002,100.30000000000001" aria-expanded="false" data-coords="160,90,170,100">-->
        </map>
        <div id="theimage" src="{{ asset('/img/main1.png?v1.33') }}" width="1000" height="1000" border="0" usemap="#main" style="position: absolute; top: 0px; left: 0px; width: 1000px; height: 1000px; max-width: none;"></div>
        @if(isset($data))
            @foreach ($data as $el)
                @if($el->payment->status == true)
                @endif
                    <span style="cursor: pointer; position: relative; left: {{ $el->X }}px; top: {{ $el->Y }}px; background: transparent; visibility: visible;" data-gif="{{ asset('/gif/'.$el->name_gif) }}" data-url="{{ asset('/gif/'.$el->url) }}">
                        <img style="position: absolute; width: {{ $el->size }}px; height: {{ $el->size }}px;" src="{{ asset('/gif/'.$el->name_gif) }}" alt="" onclick="getUrlRedirect('{{$el->url}}')">
                    </span>
            @endforeach
        @endif
        <div class="modal fade" id="pixel_info" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <img id="modal-gif" style="width:100%;" src="" alt="gif">
                    </div>
                    <div id="modal-url" class="modal-body">

                    </div>
                    <div class="modal-footer">
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function load_modal_info(url, gif) {
        $("#modal-gif").attr("src",gif);
        $("#modal-url").html('<a href="'+url+'" target="_blank">'+url+'</a>');
    }

    function getUrlRedirect(url) {
        window.open('https://tiktok.com/@'+url, '_blank');
    }
</script>
@include('template/footer')