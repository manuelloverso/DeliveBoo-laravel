<div class="body">
    <div class="header">
        <img width="100" class="nav-logo" src="{{ Vite::asset('resources/img/logo.svg') }}" alt="">
        <h1>Deliverome</h1>
    </div>
    @if ($lead['target'] == 'restaurant')
        <h2>Nuovo Ordine Ricevuto</h2>
    @else
        <h2>Ordine effettuato correttamente</h2>
    @endif

    @if ($lead['target'] == 'restaurant')
        <h2>Informazioni Cliente</h2>
        <p><strong>Ordine Numero: </strong>{{ $lead['order_id'] }}</p>
        <p><strong>Email: </strong>{{ $lead['customer_email'] }}</p>
        <p><strong>Indirizzo: </strong>{{ $lead['customer_address'] }}</p>
        <p><strong>Num. di telefono: </strong>{{ $lead['customer_phone'] }}</p>
        <p><strong>Totale Ordine: </strong>{{ $lead['order_total'] }}€</p>
    @else
        <h2>Informazioni Ristorante</h2>
        <p><strong>Totale Ordine: </strong>{{ $lead['order_total'] }}€</p>
        <p><strong>Nome: </strong>{{ $lead['restaurant_name'] }}€</p>
        <p><strong>Indirizzo: </strong>{{ $lead['restaurant_address'] }}</p>
        <p><strong>Num. di telefono: </strong>{{ $lead['restaurant_phone'] }}</p>
    @endif

    <h3>{{ $lead['target'] == 'restaurant' ? 'Contenuto' : 'Riepilogo' }} Ordine</h3>
    <div class="cart">
        <table>
            <thead>
                <th>ID</th>
                <th>Nome Piatto</th>
                <th>Prezzo</th>
            </thead>
            <tbody>

                @foreach ($lead['cart'] as $plate)
                    <tr>
                        <td><strong>{{ $plate['plateObj']['id'] }}</strong></td>
                        <td>{{ $plate['plateObj']['name'] }}</td>
                        <td>{{ $plate['plateObj']['price'] }}€</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($lead['target'] == 'restaurant')
        <a class="button" href="http://127.0.0.1:8000/admin/orders">Visualizza in app</a>
    @else
        <h2>Grazie per averci scelto !</h2>
        <a class="button" href="http://localhost:5173/">Continua ad ordinare</a>
    @endif
</div>

<style>
    .button {
        display: inline-block;
        color: white;
        text-decoration: none;
        background-color: rgb(255, 157, 0);
        padding: 5px 8px;
        margin: 20px 0;
        font-size: 1.1rem;
        border-radius: 10px;
    }

    .body {
        font-family: sans-serif;
    }

    .header {
        display: flex;
        gap: 2rem
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }
</style>
