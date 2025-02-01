<?php
//Redireccion si navegamos desde un movil
include 'includes/Mobile_Detect.php';
$detect = new Mobile_Detect();

if ($detect->isMobile() || $detect->isTablet()) {
    // Redireccion any mobile device.
    header("Location: http://movil.fareco-multiasistencia.com/");
    //header("Location: http://fareco-multiasistencia.com/movil");
}

//header('Content-Type: text/html; charset=UTF-8');
//date_default_timezone_set('Europe/Madrid');

//ACCION POST
if (isset($_POST['enviaremail']) && $_POST['enviaremail']=="1") {
	$nombre = $_POST['nombreform'];
	$status = $_POST['statusform'];
	$email = $_POST['emailform'];
	$mensaje = $_POST['mensajeform'];
	//print ($nombre." ".$status." ".$email." ".$mensaje);
	$subject = "[Contacto Fareco-Multiasistencia Web] Contacto de " . $status;
	$cabeceras = 'From: ' . $nombre . "<" .  $email . ">\r\n" .
		'Reply-To: ' . $email;
	if (mail("info@fareco-multiasistencia.com", $subject, $mensaje, $cabeceras))	$mailenviado = true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
	<title>FARECO: Asistencia Urgente y Reformas en Sotillo de la Adrada - <?php print($title); ?></title>
	<meta name="keywords" content="reformas asistencia urgente chapuzas albañileria albañil fontaneria casa casas Sotillo de la Adrada Santa Maria Higuera de las Dueñas Fresnedilla Avila
		Valle del Tietar Gredos fareco sl electricidad electricista goteras reforma gotera hogar hogares comunidad comunidades negocio
		negocios empresa empresas" />
	<meta name="Description" content="Reformas y asistencia urgente para su hogar, negocio o comunidad de vecinos, de la mano de Fareco S.L." />
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="lang" content="es" />
	<meta name="organization" content="Fareco" />
	<meta name="locality" content="Sotillo de la Adrada, España" />
	
	<link rel="shortcut icon" href="css/images/favicon.ico"/>
	
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Ubuntu'/>
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Bitter'/>
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans'/>
	<!--<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Nova+Square'/>-->
	<link rel="stylesheet" type="text/css" href="css/style6.css" />
	<link rel="stylesheet" type="text/css" href="css/basic.css" />
	<link rel="stylesheet" type="text/css" href="css/galleriffic-2.css" />
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.0/themes/cupertino/jquery-ui.css"/>
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	
	
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	<script type="text/javascript" src="js/jquery.ui.map.js"></script>
	<script type="text/javascript" src="js/jquery.galleriffic.js"></script>
	<script type="text/javascript" src="js/jquery.opacityrollover.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script language="javaScript" type="text/javascript">
        //<![CDATA[
		//Dialogo de confirmacion del email de contacto
		function dialogo(mensajeconfirmar) {
			var icono= "ui-icon-circle-check";
			var titulo="Contacto";
			
			if (mensajeconfirmar=="")
				mensajeconfirmar="¡Mensaje enviado correctamente! Nos pondremos en contacto lo antes posible. Gracias.";
			else
				icono = "ui-icon-circle-close";

			$("#dialog-ok").attr("title", titulo);
			$("#dialog-ok p span").attr("class", "ui-icon "+icono);
			$("#dialog-ok p span").after(mensajeconfirmar);
			$( "#dialog-ok" ).dialog({
				minWidth: 410,
				hide: "explode",
				modal: true,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
		
		$(document).ready(function() {	
			//Hide H1 and H2
			$("#header").hide();
			
			//Tooltips
			//$( document ).tooltip();
			
			//Acordeon Home
			$( ".notcont" ).accordion();

			/*MODAL FORM*/
			var nombre = $( "#nombre" ),
				status = $( "#status" ),
				email = $( "#email" ),
				mensaje = $( "#mensaje" ),
				allFields = $( [] ).add( nombre ).add( email ).add( mensaje ),
				tips = $( ".validateTips" );
	 
			function updateTips( t ) {
				tips
					.text( t )
					.addClass( "ui-state-highlight" );
				setTimeout(function() {
					tips.removeClass( "ui-state-highlight", 1500 );
				}, 500 );
			}
	 
			function checkLength( o, n, min, max ) {
				var longitud = o.val();
				if ( longitud.length > max || longitud.length < min ) {
					o.addClass( "ui-state-error" );
					updateTips( "La longitud de " + n + " debe ser entre " +
						min + " y " + max + "." );
					return false;
				} else {
					return true;
				}
			}
	 
			function checkRegexp( o, regexp, n ) {
				if ( !( regexp.test( o.val() ) ) ) {
					o.addClass( "ui-state-error" );
					updateTips( n );
					return false;
				} else {
					return true;
				}
			}
 
			$( "#dialog-form" ).dialog({
				autoOpen: false,
				height: 530,
				width: 350,
				modal: true,
				position: { my: "top-70%", at: "center", of: window },
				buttons: {
					"Enviar": function() {
						var bValid = true;
						allFields.removeClass( "ui-state-error" );
	 
						bValid = bValid && checkLength( nombre, "nombre", 3, 30 );
						bValid = bValid && checkLength( email, "email", 6, 80 );
						bValid = bValid && checkLength( mensaje, "mensaje", 1, 500 );
	 
						//bValid = bValid && checkRegexp( nombre, /^([0-9a-zA-Z])+$/, "El campo nombre sólo puede contener letras o números." );
						bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "Email erróneo: ej. ejemplo@fareco-multiasistencia.com" );
	 
						if ( bValid ) {
							$( "#nombreform" ).val( nombre.val() );
							$( "#statusform" ).val( status.val() );
							$( "#emailform" ).val( email.val() );
							$( "#mensajeform" ).val( mensaje.val() );
							$( "#enviaremail" ).val( "1" );
							$( this ).dialog( "close" );
							$( "#form2" ).trigger( "submit" );
						}
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				},
				close: function() {
					allFields.val( "" ).removeClass( "ui-state-error" );
				}
			});
	 
			$( "#contactar" ).click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
			
			/*Google maps*/
			$('#map_canvas').gmap({'center': '40.29250177676654,-4.582130312919617', 'zoom': 16, 'disableDefaultUI':true, 'callback': function() {
					var self = this;
					self.addMarker({'position': this.get('map').getCenter() }).click(function() {
						self.openInfoWindow({ 'content': 'Fareco S.L. - Reformas y Multiasistencia' }, this);
					});	
			}});
			
			$( "#recmap" ).click(function() {
				setTimeout(function(){$('#map_canvas').gmap('refresh');},500);
			});
			
		});
        //]]>
	</script>
	<script type="text/javascript">
	  (function() {
		var cx = '004082113215533452389:lwaeiptgryw';
		var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
		gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
			'//www.google.com/cse/cse.js?cx=' + cx;
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
	  })();
	</script>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-39016168-1']);
	  _gaq.push(['_setDomainName', 'www.fareco-multiasistencia.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>

<body>
	<div id="fb-root"></div>
	<script type="text/javascript">
	  window.fbAsyncInit = function() {
		// init the FB JS SDK
		FB.init({
		  appId: '',
		  channelUrl : 'HTTP://WWW.SANCHEZSESENA.COM/fareco/channel.html', // Channel File for x-domain communication
		  status     : true, // check login status
		  cookie     : true, // enable cookies to allow the server to access the session
		  oauth      : true, // enable OAuth 2.0
		  xfbml      : true  // parse XFBML
		});

		// Additional initialization code such as adding Event Listeners goes here

	  };

	  // Load the SDK's source Asynchronously
	  (function(d){
		 var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
		 js = d.createElement('script'); js.id = id; js.async = true;
		 js.src = "//connect.facebook.net/es_ES/all.js";
		 d.getElementsByTagName('head')[0].appendChild(js);
	   }(document));
	</script>
	<div id="dialog-form" title="Contacto">
		<p class="validateTips">Todos los campos son obligatorios. Es recomendable dejar un teléfono en el mensaje.</p>

		<fieldset>
			<label for="nombre">Nombre</label>
			<input name="nombre" id="nombre" title="Introduce un nombre" class="text ui-widget-content ui-corner-all" />
			<label for="status">Estatus</label>
			<select name="status" id="status" class="text ui-widget-content ui-corner-all" >
				<option id="cliente">Cliente</option>
				<option id="profesional">Profesional</option>
			</select>
			<label for="email">Email</label>
			<input name="email" id="email" title="Introduce un email de contacto" value="" class="text ui-widget-content ui-corner-all" />
			<label for="mensaje">Mensaje (máx. 500 caracteres)</label>
			<textarea name="mensaje" id="mensaje" title="Introduce el mensaje" class="text ui-widget-content ui-corner-all" rows="2" cols="2"></textarea>
		</fieldset>
	</div>
	<div id="dialog-ok"><p><span style="float:left;"></span></p></div>
	<div id="upcontenedor" align="center">
		<?php if (isset($mailenviado)) {
				if ($mailenviado)
					print('<script type="text/javascript">dialogo("");</script>');
				else
					print('<script type="text/javascript">dialogo("No se ha podido mandar el mensaje. Inténtalo de nuevo, por favor.");</script>');
			  }
		?>
		
		<!-- CONTACT FORM -->
		<form action="" method="post" id="form2">
			<input type="hidden" id="nombreform" name="nombreform"/>
			<input type="hidden" id="statusform" name="statusform"/>
			<input type="hidden" id="emailform" name="emailform"/>
			<input type="hidden" id="mensajeform" name="mensajeform"/>
			<input type="hidden" id="enviaremail" name="enviaremail" value="0"/>
		</form>

	</div>	
	<div id="supercontenedor">
		<div id="menucreativesuperior">
			<div id="menucreative">
				<ul class="ca-menu">
					<li id="icon_home">
						<a href="home">
							<span class="ca-icon"></span>
							<div class="ca-content">
								<h2 class="ca-main">Nosotros</h2>
								<h3 class="ca-sub">¿Quiénes somos?</h3>
							</div>
						</a>
					</li>
					<li id="icon_gallery">
						<a href="galeria">
							<span class="ca-icon"></span>
							<div class="ca-content">
								<h2 class="ca-main">Galería</h2>
								<h3 class="ca-sub">Nuestros mejores trabajos</h3>
							</div>
						</a>
					</li>
					<li id="icon_asistance">
						<a href="multiasistencia">
							<span class="ca-icon"></span>
							<div class="ca-content">
								<h2 class="ca-main">Asistencia</h2>
								<h3 class="ca-sub">Urgencias a domicilio</h3>
							</div>
						</a>
					</li>
					<li id="icon_reform">
						<a href="reformas">
							<span class="ca-icon"></span>
							<div class="ca-content">
								<h2 class="ca-main">Reformas</h2>
								<h3 class="ca-sub">Presupuesto sin compromiso</h3>
							</div>
						</a>
					</li>
					<!--<li id="icon_location">
						<a href="localizacion">
							<span class="ca-icon"></span>
							<div class="ca-content">
								<h2 class="ca-main">Localización</h2>
								<h3 class="ca-sub">¿Dónde encontrarnos?</h3>
							</div>
						</a>
					</li> -->
					<li id="contactar">
						<a href="#">
							<span class="ca-icon"></span>
							<div class="ca-content">
								<h2 class="ca-main">Contacto</h2>
								<h3 class="ca-sub">Disponibilidad inmediata</h3>
							</div>
						</a>
					</li>
				</ul>
				<div id="imagemenulogo">
					<a href="home"><img alt="Imagen del logo de Fareco S.L. Reformas y Multiasistencia" src="css/images/fareco_logo.png" /></a>
				</div>
				<div class="searchcontainer">
					<gcse:searchbox-only></gcse:searchbox-only>
				</div>
			</div>
		</div>
		<div id="header" align="center">
			<div id="global_titulo">
				<div id="titulo"><h1>FARECO - MULTIASISTENCIA Y REFORMAS</h1></div> <br />
                <div id="titulo2"><h2>Albañiles, Fontaneros, Electricistas, Pintores, Jardineros, Carpinteros...</h2></div>
			</div>
		</div>
		<div id="global_wrapper">
			<div id="contenido_wrapper">
				<div id="contenido">