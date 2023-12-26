<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionales personalizados */
        /* Puedes agregar estilos adicionales aquí */
    </style>
</head>

<body class="bg-gray-100 p-4">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-md shadow-md">
        <h1 class="text-3xl font-semibold mb-6">Factura</h1>

        <!-- Detalles del cliente -->
        <div class="flex justify-between mb-6">
            <div>
                <h2 class="text-lg font-semibold">Cliente:</h2>
                <p>{{ $venta->user->name}}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Fecha:</h2>
                <p>{{ $venta->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
        <table class="w-full mb-6">
    <thead>
        <tr>
            <th class="text-left">Descripción</th>
            <th class="text-right">Cantidad</th>
            <th class="text-right">Precio Unitario</th>
            <th class="text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($venta->carts as $detalle)
        <tr>
            <td>{{ $detalle->name_product }}</td>
            <td class="text-right">{{ $detalle->quantity }}</td>
            <td class="text-right">{{ $detalle->price }}</td>
            <td class="text-right">${{ $detalle->quantity * $detalle->price }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="text-right font-semibold">Total:</td>
            <td class="text-right font-semibold">${{ $venta->price_total }}</td>
        </tr>
    </tfoot>
</table>

<!-- Información adicional o notas -->
<div class="border-t pt-4">
    <p>Agradecimiento por tu compra:</p>
    <p>¡Gracias por confiar en nosotros para abastecer tus necesidades de comida y productos! Nos esforzamos por ofrecer los mejores productos y servicios para satisfacer tus requerimientos.</p>
    <p>Si tienes alguna consulta sobre nuestros productos, necesitas ayuda adicional o deseas realizar pedidos personalizados, no dudes en contactarnos. Estamos aquí para proporcionarte el mejor servicio posible.</p>
    <p>¡Gracias nuevamente por elegirnos para satisfacer tus necesidades de alimentos y productos!</p>
</div>


    </div>
</body>

</html>
