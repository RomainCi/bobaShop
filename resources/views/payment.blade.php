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
    <header>
        <navbar-component></navbar-component>
    </header>
    <main>
        <section>

            <div>
                <h1>Paiement</h1>
            </div>
            <div class="container">
                <div class="content contentMax">
                    <h2>Votre compte</h2>
                    <p>email : dzdad</p>
                </div>

                <div class="tata">
                    <div class="content test">
                        <h2>Information</h2>
                        <p>nom</p>
                        <p>Prénom</p>
                        <p>numero de telephone</p>
                        <p>Adresse</p>
                        <p>Pays</p>
                        <p>Code postal</p>
                    </div>

                    <div class="content test">
                        <h2>Résumé de votre commande</h2>
                        <p>article</p>
                        <p>prix</p>
                    </div>

                </div>
                <div class="content contentMax">
                    <h2>Méthode de paiement</h2>
                    <div id="card-element"></div>
                </div>
            </div>
        </section>
    </main>

</div>
@vite('resources/js/app.js')
<script src="https://kit.fontawesome.com/40f157f11e.js" crossorigin="anonymous"></script>
</body>
</html>