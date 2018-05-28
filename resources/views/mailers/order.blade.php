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
@foreach ($promotions as $promotion)
| {{$promotion->nombre}} (promoción)     | {{$promotion->pivot->qty}} |        {{$promotion->pivot->preciounit*$promotion->pivot->qty}} |
@endforeach
| Envio       |          | {{$order->shoppingcart->totalenvio}}  |
| Total       |          | {{$order->total}}  |
@endcomponent
@component('mail::button', ['url' => $url])
Ver mi pedido
@endcomponent
Gracias,<br>
{{ config('app.name') }}
@endcomponent