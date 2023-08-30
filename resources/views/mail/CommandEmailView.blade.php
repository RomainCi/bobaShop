<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vérification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Bon de commande</h1>
    <p>Date : {{ \Carbon\Carbon::now('Europe/Paris')->format('d/m/Y') }}</p>
    <p>Heure de récupération : {{$orders->hours}}</p>
    <p>Nom : {{$orders->user->lastname}}</p>
    <p>Prénom : {{$orders->user->firstname}}</p>
    <p>Téléphone : {{$orders->user->phone}}</p>
    <h2>Détails des commandes :</h2>
    <table>
        <thead>
        <tr>
            <th>Menu</th>
            <th>Thé</th>
            <th>Perles</th>
            <th>Sirop</th>
            <th>Sides</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders->ordersMenu as $product)
            <tr>
                <td>{{$product->menus->name}}</td>
                <td>{{$product->teas->name}}</td>
                <td>{{$product->pearls->name}}</td>
                <td>{{$product->syrups->name}}</td>
                <td>@forelse ($product->sides as $side)
                        <li style="list-style: none">{{ $side->side->name }}</li>
                    @empty
                        Aucun
                    @endforelse</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h2>Total des ventes :</h2>
    <p>Montant total TTC : {{ $orders->total_price }} €</p>
</div>
</body>
