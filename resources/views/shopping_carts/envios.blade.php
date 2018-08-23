<tr>
	<td>Shipping via Sky Conexion</td>
	<td></td>
	<td></td>
	<td>$ {{number_format(round($precio_envio*.50,2,PHP_ROUND_HALF_UP),2)}} USD</td>
	{{-- <td>$ {{$precio_envio*.50}} US</td> --}}
</tr>
<tr>
	<td>Custom</td>
	<td></td>
	<td></td>
	<td>$ {{number_format(round($precio_envio*.25,2,PHP_ROUND_HALF_UP),2)}} USD</td>
	{{-- <td>$ {{$precio_envio*.25}} US</td> --}}
</tr>
<tr>
	<td>THC</td>
	<td></td>
	<td></td>
	<td>$ {{number_format(round($precio_envio*.25,2,PHP_ROUND_HALF_DOWN),2)}} USD</td>
	{{-- <td>$ {{$precio_envio*.25}} US</td> --}}
</tr>
<tr class="background-blueth" id="total">
    <td></td>
    <td></td>
    <td class="t-r f-b">Total</td>
    <td>$ {{number_format($total+$precio_envio,2)}} USD</td>
</tr>