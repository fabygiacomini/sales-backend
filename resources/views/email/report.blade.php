<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Roboto', 'sans-serif';
            }
            table, th, td {
                border: 1px solid #999999;
                padding: 0.5rem;
                text-align: center;
            }
            th {
                background-color: #2d3748;
                color: #edf2f7;
            }
            td {
                background-color: #edf2f7;
                color: #2d3748;
            }
        </style>
    </head>
    <body>
        <p>Olá, boa noite!</p>
        <p></p>

        @if (count($sales) <= 0)
            <p>Não foram realizadas vendas na data de hoje.</p>
        @else
            <p>Veja as vendas realizadas no dia de hoje {{date('d/m/Y', time())}} pelos nossos vendedores:</p>
            <table>
                <thead>
                    <tr>
                        <th>Venda</th>
                        <th>Vendedor</th>
                        <th>Valor da venda</th>
                        <th>Comissão do vendedor</th>
                        <th>Data/Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{$sale->id}}</td>
                            <td>{{$sale->name}}</td>
                            <td>R$ {{$sale->sale_value}}</td>
                            <td>R$ {{$sale->sale_commission}}</td>
                            <td>{{date('d/m/Y H:i:s', strtotime($sale->sale_time))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if($totalSales > 0)
            <p>O valor total das vendas de hoje é de R$ {{$totalSales}}.</p>
        @endif
        <p></p>
        <p>At.te,</p>
        <p>Loja Tray Homework</p>
    </body>
</html>
