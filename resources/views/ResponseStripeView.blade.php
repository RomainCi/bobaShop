<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('style/style.css') }}" rel="stylesheet">
    <title>Réponse du paiement</title>
</head>
<body>
<div class="container-title">
    <h1>Réponse de paiement</h1>
    <img src="{{asset('images/index/imageLogo.png')}}" alt="logo">
</div>
<div class="container-response">
    <p>Le paiement a été {{$res['message']}} pour votre commande de {{$res['price']}} €</p>
    @if($res['status'] === "failed")
        <p>Vous pouvez retourner a la page de paiement</p>
        <a href="{{ route('show.paiement', ['id' => $id]) }}">page de paiement</a>

    @else
        <p>Vous allez recevoir un email dans 15 min avec la facture en pièce jointe. N'oubliez pas de vérifier vos spams
            si cela n'apparaît
            pas.</p>
        <a href="/">retourner l'accueil</a>
    @endif
</div>
</body>
</html>
