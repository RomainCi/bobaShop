<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .invoice-header:after {
            content: "";
            display: block;
            clear: both;
        }

        .invoice-header h1 {
            font-size: 24px;
            font-weight: bold;
            float: left;
            margin: 0;
        }

        .invoice-header img {
            max-height: 25px;
            background-color: black;
            float: right;
        }

        .invoice-info {
            margin-bottom: 30px;
        }

        .invoice-info:after {
            content: "";
            display: block;
            clear: both;
        }

        .invoice-info div {
            width: 50%;
            float: left;
            text-align: center;
        }

        .invoice-info .invoice-number {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .invoice-info p {
            margin: 0;
        }

        .invoice-details {
            margin-bottom: 30px;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-details th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: left;
        }

        .invoice-details td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .invoice-total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .invoice-total div {
            margin-bottom: 10px;
        }

        .invoice-total p {
            display: inline-block;
            margin: 0 10px 0 0;
            text-align: left;
        }

        .invoice-total span {
            display: inline-block;
            min-width: 120px;
            text-align: right;
        }

        li {
            list-style: none;
        }

        footer p {
            font-size: 9px;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 5px;
            left: 0;
            right: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="invoice-header">
        <h1>Facture</h1>
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo">
    </div>
    <div class="invoice-info">
        <div>
            @if($user->information->society !== null)
                <p>Société :</p>
                <p>{{$user->information->society}}</p>
                <p>{{$user->information->street}}</p>
                <p>{{$user->information->city}}, {{$user->information->postal_code}}</p>
                <p>{{$user->information->country}}</p>
            @else
                <p>Client :</p>
                <p>{{$user->lastname}}, {{$user->firstname}}</p>
                <p>{{$user->information->street}}</p>
                <p>{{$user->information->city}}, {{$user->information->postal_code}}</p>
                <p>{{$user->information->country}}</p>
            @endif
        </div>
        <div>
            <p>Date : {{$formattedDate}}</p>
            <p class="invoice-number">N°FACTURE : {{$order->invoice->number}}</p>
        </div>
    </div>
    <div class="invoice-details">
        <table>
            <thead>
            <tr>
                <th>Description</th>
                <th>Thé</th>
                <th>Perle</th>
                <th>Sirop</th>
                <th>Side</th>
                <th>Prix unitaire <br>HT</th>
                <th>Prix unitaire <br>TTC</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->ordersMenu as $product)
                <tr>
                    <td>{{$product->menus->name}}</td>
                    <td>{{$product->teas->name}}</td>
                    <td>{{$product->pearls->name}}</td>
                    <td>{{$product->syrups->name}}</td>
                    <td>@forelse ($product->sides as $side)
                            <li>{{ $side->side->name }}</li>
                        @empty
                            Aucun
                        @endforelse</td>
                    <td>{{number_format($product->menus->price / (1 + 5.5/100), 2, '.')}} €</td>
                    <td>{{$product->menus->price}} €</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="invoice-total">
        <div>
            <p>Total HT :</p>
            <span>{{number_format($order->total_price / (1 + 5.5/100), 2, '.')}} €</span>
        </div>
        <div>
            <p>TVA 5,50 % : </p>
            <span>{{number_format($order->total_price * (5.5 / (100 + 5.5)), 2, '.')}} €</span>
        </div>
        <div>
            <p>Total TTC :</p>
            <span>{{$order->total_price}} €</span>
        </div>
    </div>
</div>
<footer>
    <p class="footer">BLOMOCH SAS au capital de 1000.00€ - Siège social : 26 Rue de la Mesange 67000 STRASBOURG -
        Numéro de siret :
        92197271700018 - Numéro TVA intracommunautaire : FR23921972717</p>
</footer>
</body>
</html>

