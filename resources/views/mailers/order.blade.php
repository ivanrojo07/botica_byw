<!DOCTYPE hmtl>

<html>

<head>

	<meta charset="UTF-8">

	<title>Mail</title>

</head>

<body>

	<h1>!Hola</h1>

	<p>Te enviamos los datos de tu compra realizada en Tufarmacialatina.com</p>



	<table>

		<thead>

			<tr>

				<th>

					producto

				</th>

				<th>

					costo

				</th>

			</tr>

		</thead>

		

		<tbody>
			<tr>
				
			@foreach($products as $product)

				<td>{{ $product->descripcion}}</td>

				<td>$ {{ $product->pivot->preciounit}} USD</td>

			@endforeach
			</tr>

			<tr>

				<td>Total</td>

				<td>$ {{$order->total}} USD</td>

			</tr>

		</tbody>

	</table>

</body>

</html>