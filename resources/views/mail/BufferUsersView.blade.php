<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vérification</title>
</head>
<body>
<main>
    <section>
        <p>Bonjour {{$lastname}},</p>
        <br>
        <p>Pour confirmer l'envoie de votre message veuillez cliquez sur le lien ci dessous</p>
        <a href="http://127.0.0.1:8000/confirmation/email/id={{$id??null}}&token={{$token??null}}">test</a>
        <p>Le lien expire dans 10min</p>
        <p>Si vous êtes pas à l'origine de l'envoie de ce message veuillez ignorez ceux message, ceci est un message
            automatique.</p>
        <p>Cordialement l'équipe de BobaShop</p>
    </section>
</main>
{{--<footer>--}}
{{--    <br>--}}
{{--    <br>--}}
{{--    <b>INDOOR-SANTÉ</b>--}}
{{--    <p><a href="tel:+33645969998">06 45 96 99 98</a> </p>--}}
{{--    <p><a href="mailto:info@indoor-sante.fr">info@indoor-sante.fr</a></p>--}}
{{--    <p><a href="https://indoorsante.osc-fr1.scalingo.io/">site web</a></p>--}}
{{--    <img style="height: 82px;width: 124px"--}}
{{--         src="http://127.0.0.1:5173/resources/assets/logo.png"--}}
{{--         alt="logo indoor santé">--}}
{{--    <p>Suivez nous sur les réseaux:</p>--}}
{{--    <p style="color: #500050">Facebook: <a href="https://www.facebook.com/indoorsante">https://www.facebook.com/indoorsante</a></p>--}}
{{--    <p style="color: #500050">Instagram: <a href="https://www.instagram.com/indoor_sante/">https://www.instagram.com/indoor_sante/</a></p>--}}
{{--    <p style="color: #500050">Linkedin: <a--}}
{{--                href="https://www.linkedin.com/company/indoor-sante/">https://www.linkedin.com/company/indoor-sante/</a>--}}
{{--    </p>--}}
{{--</footer>--}}
</body>
</html>