<section style="padding:15px;">
	<h1>{{ ucfirst($user) }}</h1>
	<br/>
	<p>Hemos recibido una solicitud de cambio de contraseña desde la aplicación movil Yezzclub Android. Por favor ingresa en la aplicación android con la siquiente contraseña y completa los pasos para cambiar tu contraseña.</p>
	<br/>
	<div style="background: black;
    color: white;
    text-transform: lowercase;
    padding: 10px;
    width: 10%;
    text-align: center;">{{ $password }}</div>
	<br/>
    <em>Esta contraseña temporal es por tiempo limitado, tiene exactamente hasta {{ $date }} para ingresar a su aplicación y completar lo pasos.</em>
</section>
