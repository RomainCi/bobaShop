<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Salon de thé vente de bubble tea a emporter fusion
latino-asiatique. Restauration à emporter, menus à petit prix pour tous les régimes
alimentaires. 26 rue de la mesange, 67000 Strasbourg, France.">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
        <link rel="shortcut icon" href="{{ asset('images/logo/boba.avif') }}">
    <title>BOBA SHOP</title>
    @vite('resources/css/app.css')

</head>
<body>
<div class="loading-container-home">
    <div class="loading-bar">
        <div class="progress"></div>
    </div>
    <p>Chargement en cours ...</p>
</div>


<div id="app">
    <app :connexion-admin="<?php echo json_encode(Auth::guard('admin')->check()); ?>"
         :connexion-user="<?php echo json_encode(auth()->check()); ?>"
       ></app>
</div>
@vite('resources/js/app.js')
<script src="https://js.stripe.com/v3/" crossorigin async></script>
<script src="https://kit.fontawesome.com/40f157f11e.js" crossorigin="anonymous" async></script>
</body>
</html>
