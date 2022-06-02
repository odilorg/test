<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>The Million Tiktokers Homepage </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="{{ asset('/css/style.css?v1.177') }}">
        <meta name="yandex-verification" content="6136771bbdeb6ecc" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/img/favicon/favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/img/favicon/favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon/favicon.ico') }}">
        <link rel="manifest" href="{{ asset('/img/favicon/favicon.ico') }}">
        <link rel="mask-icon" href="{{ asset('/img/favicon/favicon.ico') }}">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
</head>

<script>
    /*
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('')
    } else {
        alert('pc');
    
    }
    */
</script>


<body>

    <div class="header">
        @if($userinfo == 'true')
        <div class="header-userinfo">
            <div class="header-userinfo__name">
                Hello, {{$username}}!
            </div>
            <div class="header-userinfo__btn-logout">
                <a href="/logout">Logout</a>
            </div>
        </div>
        @endif
        <h1 class="header__logo">The Million TikTokers Homepage </h1>
        <script>
            if(window.screen.width <= 600) {
                $('.header__logo').css('font-size', '24px');
            }
        </script>
        <ul>
            <li>1, 000,000 pixels </li>
            <li>1 per pixel = 1$</li>
            <li>Own a piece of internet history</li>
        </ul>
        <div class="sold">
            <h3>Sold: {{ ($pixels_left->sold) ? $pixels_left->sold : '0'  }}</h3>
            <h4>Available: {{ ($pixels_left->available) ? $pixels_left->available : '0' }}</h4>
        </div>
    </div>
    <div class="header_nav">
        <a class="tiktok" href="https://www.tiktok.com/@milliontiktokershomepage" target="_blank"><img src="/img/tik-tok.png" alt="tiktok">Follow TikTok</a>
        <ul>
            <li><a href="/">Homepage</a></li>
            <!--<li class="before">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    Buy pixel
                </button>
            </li>-->
            <li class="before">
                <a href="/selectpixel">
                    Buy pixel
                </a>
            </li>
            <li class="before">
                <a href="https://www.donationalerts.com/r/ninerbro">
                    Donate
                </a>
            </li>
            <!--<li class="before">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop3">
                    Test
                </button>
            </li>-->
            <li class="before">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#about_us">
                    About project
                </button>
            </li>
            <li class="before">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#contact_me">
                    Contact me
                </button>
            </li>
        </ul>
    </div>

    
    