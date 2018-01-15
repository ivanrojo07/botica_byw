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
			@foreach($products as $product)
				<tr>{{ $product->title}}</tr>
				<tr>{{ $product->pricing}}</tr>
			@endeach
			<tr>
				<td>Total</td>
				<td>{{$order->$total}}</td>
			</tr>
		</tbody>
	</table>
</body>
</html>