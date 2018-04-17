@component('mail::message')
# ¡Muchas gracias por tu compra!

Tu orden no. {{$order->shoppingcart->customid}} ha sido creada!

Resumen del pedido:

@component('mail::table')
| Producto       | Cantidad         | Total  |
|:------:   |:-----------:|:--------: |
@foreach ($products as $producto)
| {{$producto->descripcion}}     | {{$producto->pivot->qty}} |        {{$producto->pivot->preciounit*$producto->pivot->qty}} |
@endforeach
| Total       |          | {{$order->total}}  |

@endcomponent

@component('mail::button', ['url' => $url])
Ver mi pedido
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent