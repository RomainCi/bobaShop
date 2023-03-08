<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Salon de thé vente de bubble tea a emporter fusion
latino-asiatique. Restauration à emporter, menus à petit prix pour tous les régimes
alimentaires. 26 rue de la mesange, 67000 Strasbourg, France.">
    {{--    <link rel="shortcut icon" href="{{ asset('image/favicon- 16x16.png') }}">--}}
    <title>BOBA SHOP</title>
    @vite('resources/css/app.css')
</head>
<body style="margin: 0">
<div id="app">
{{--    <test-component :tata="{{ auth()->check() }}"></test-component>--}}
{{--    <navbar-component :tata="'hello'"></navbar-component>--}}
    <app :test="{{Auth::guard('admin')->check()}}"></app>
</div>
@vite('resources/js/app.js')
<script src="https://kit.fontawesome.com/40f157f11e.js" crossorigin="anonymous"></script>
</body>
</html>
