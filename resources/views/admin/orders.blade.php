<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Admin Template</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
</head>

<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Follow on Twitter</a></li>
                            <li><a href="#" class="text-white">Like on Facebook</a></li>
                            <li><a href="#" class="text-white">Email me</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-start">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <svg width="20px" height="20px" style="margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#fff" d="M427.9 52.1c-20.13-20.23-47.58-25.27-65.63-14.77c-51.63 30.08-158.6-46.49-281 75.91c-122.4 122.4-45.83 229.4-75.91 281c-10.5 18.05-5.471 45.5 14.77 65.63c20.13 20.24 47.58 25.27 65.63 14.77c51.63-30.08 158.6 46.49 281-75.91c122.4-122.4 45.83-229.4 75.91-281C453.2 99.69 448.1 72.23 427.9 52.1zM211.9 127.5C167.6 138.7 106.7 199.6 95.53 243.9C93.69 251.2 87.19 255.1 79.1 255.1c-1.281 0-2.594-.1562-3.906-.4687C67.53 253.4 62.34 244.7 64.47 236.1c14.16-56.28 83.31-125.4 139.6-139.6c8.656-2.031 17.25 3.062 19.44 11.62C225.7 116.7 220.5 125.3 211.9 127.5z"/></svg>
                    <strong>Admin</strong>
                </a>
                <a href="{{ route('admin.orders') }}" class="btn btn-light" style="margin-right: 10px;">
                    <strong>Orders</strong>
                </a>
                <a href="{{ route('admin.screenshot') }}" class="btn btn-light">
                    <strong>Screenshot</strong>
                </a>
                <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>-->
            </div>
        </div>
    </header>
    <main>
        <section class="py-5 container">
            <div class="row">
                <div class="mb-3">
                    <h1>Orders</h1>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Link to GIF</th>
                            <th scope="col">TikTok URL</th>
                            <th scope="col">Payment State</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($Orders as $order)
                        
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            @foreach ($Users as $user)
                                @if ($user->id == $order->user_id)
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @endif
                            @endforeach
                                <td><a href="{{ asset('/gif/'.$order->name_gif) }}" target="_blank">{{ $order->name_gif }}</a></td>
                                <td><a href="https://tiktok.com/{{ '@'.$order->url }}" target="_blank">{{ $order->url }}</a></td>
                                @foreach ($Payment as $pay)
                                    @if ($pay->order_id == $order->id)
                                    @if(isset($pay->status))
                                    <td>Success</td>
                                    @else
                                    <td>False</td>
                                    @endif
                                    @endif
                                @endforeach
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <footer class="text-muted py-5">
    </footer>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>