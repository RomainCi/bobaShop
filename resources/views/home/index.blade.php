<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('style/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('style/menu-unity.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rufina&display=swap" rel="stylesheet">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<div id="app">
    <body>
    <header>
        <navbar-component></navbar-component>
    </header>
    <main>
        <section>
            @include('home.hero-banner-index')
        </section>
        <section>
            @include('home.menu-unity-index',['productsMenus'=> $productsMenus])
        </section>
    </main>
    @vite('resources/js/app.js')
    <script src="https://kit.fontawesome.com/40f157f11e.js" crossorigin="anonymous"></script>
    </body>
</div>
</html>
