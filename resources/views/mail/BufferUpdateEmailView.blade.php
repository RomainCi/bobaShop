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
        <p>Bonjour</p>
        <br>
        <p>Pour confirmer le changement de votre address mail cliquer sur le lien ci dessous </p>
        <a href="http://127.0.0.1:8000/update/email/id={{$id??null}}&token={{$token??null}}">test</a>
        <p>Le lien expire dans 10min</p>
        <p>Si vous êtes pas à l'origine de l'envoie de ce message veuillez ignorez ceux message, ceci est un message
            automatique.</p>
        <p>Cordialement l'équipe de BobaShop</p>
    </section>
</main>