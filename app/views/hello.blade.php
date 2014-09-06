<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The Vaquitapp API Service</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		h1{
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	<div class="welcome">
		<h1>
			Vaquitapp Server API
		</h1>
		{{ Form::open(['url' => 'vaquitas/desuscribirme/6' , 'method' => 'delete']) }}
			<input type="hidden" value="devswert" name="username">
			<input type="hidden" value="eyJpdiI6Im15Tm1kdU13Z1hqN0dPSmtOMG5kZlE9PSIsInZhbHVlIjoicGFGblRTTHNvTVlENkJObnlTZmVMbjR5MTMzY0MrUTlyTHVjQ1wvYTBOVEU9IiwibWFjIjoiMGYwNGM4MGNkYmNhN2QyY2JjMDQ4YzlkMmQwOThjYzM1NWM4N2ZhMjA5NmViYWZlOTNkMzgwYzA2MWMzZTRmZCJ9" name="token">

			<input type="hidden" name="nombre" value="La vaca de cambiazo">
			<input type="hidden" name="meta" value="233909a">
			<input type="hidden" name="id" value="2">
			<input type="hidden" name="finaliza" value="2014/08/12">
			<input type="hidden" name="descripcion" value="Esta va a ser la descricion bien chevere de todo">

			<input type="submit" value="enviar">
		{{ Form::close() }}
	</div>
</body>
</html>
