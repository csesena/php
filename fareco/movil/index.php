<?php

include '../includes/Mobile_Detect.php';
$detect = new Mobile_Detect();
if ($detect->isMobile() == false) {
    // Redireccion any browser.
    //header("Location: http://fareco-multiasistencia.com/");
    print('<script>window.location.href = "http://fareco-multiasistencia.com/";</script>');
}

date_default_timezone_set('Europe/Madrid'); 

//ACCION POST
if (isset($_POST['enviaremail']) && $_POST['enviaremail']=="1") {
	$nombre = $_POST['nombreform'];
	$status = $_POST['statusform'];
	$email = $_POST['emailform'];
	$mensaje = $_POST['mensajeform'];
	//print ($nombre." ".$status." ".$email." ".$mensaje);
        $subject = "[Contacto Fareco-Multiasistencia Mobile Web] Contacto de " . $status;
	$cabeceras = 'From: ' . $nombre . "<" .  $email . ">\r\n" .
		'Reply-To: ' . $email;
	if (mail("c.sesena@gmail.com", $subject, $mensaje, $cabeceras))
	    print('<script>window.location.href = "#dialogsi";</script>');
        else
            print('<script>window.location.href = "#dialogno";</script>');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
	<title>Multiasistencia y Reformas para Hogar Negocios en Sotillo de la Adrada - FARECO</title>
	<meta name="keywords" content="movil reformas asistencia urgente chapuzas albanileria albañil fontaneria casa casas Sotillo de la Adrada Santa Maria Higuera de las Dueñas Fresnedilla Avila
		Valle del Tietar Gredos fareco sl electricidad electricista goteras reforma gotera hogar hogares comunidad comunidades negocio
		negocios empresa empresas" />
	<meta name="Description" content="Reformas y multiasistencia para su hogar, negocio o comunidad de vecinos, de la mano de Fareco S.L." />
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="lang" content="es" />
	<meta name="organization" content="Fareco" />
	<meta name="locality" content="Sotillo de la Adrada, España" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="http://fareco-multiasistencia.com/css/images/favicon.ico"/>
	
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<script type="text/javascript" src="http://fareco-multiasistencia.com/js/jquery.ui.map.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript">
	
		$(function() {
			$('#map_canvas').gmap({'center': '40.292694, -4.582908', 'zoom': 15, 'disableDefaultUI':true, 'callback': function() {
					var self = this;
					self.addMarker({'position': this.get('map').getCenter() }).click(function() {
						self.openInfoWindow({ 'content': 'Fareco S.L. - Reformas y Multiasistencia' }, this);
					});	
			}});
			
			$( document ).bind( "pagechange", function() {
				$('#map_canvas').gmap('refresh');
			});
		});

		//Funciones para comprobar form de contacto
		$( document ).submit( function(event, data) {
			var bValid = true;
			bValid = bValid && checkRegexp( $( "#emailform" ), /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			
			if (( $( "#nombreform" ).val().trim() == "" ) || ( $( "#emailform" ).val().trim() == "" ) || ( $( "#mensajeform" ).val().trim() == "" ))
				bValid = false;
				
			if (bValid)
				$( "#enviaremail" ).val( "1" );
			else {
				event.preventDefault();
				$( "#errorcontacto" ).css("display","");
			}
		});
		
		function checkRegexp( o, regexp) {
			if ( !( regexp.test( o.val() ) ) ) {
				return false;
			} else {
				return true;
			}
		}
		
	</script>
	
</head>

<body>
<div data-role="page" id="globalpage" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Fareco S.L. - Reformas y Multiasistencia</h1>
	</div><!-- /header -->

	<div data-role="content">
	        <h1>Últimas noticias</h1>
	
			<div data-role="controlgroup" style="font-size: 1.2em;">
				<a data-transition="slideup" data-role="button" data-icon="star" data-theme="b" href="#mejoresprecios">Aprovéchate de nuestros nuevos precios (08/08/2013)</a>
				<a data-transition="slideup" data-role="button" data-icon="star" data-theme="b" href="#financiacion">Financiamos tus obras o reparaciones SIN INTERESES (26/03/2013)</a>
				<a data-transition="slideup" data-role="button" data-icon="star" data-theme="b" href="#limpmante">Contrata la limpieza y llévate el mantenimiento gratis (26/02/2013)</a>
				<a data-transition="slideup" data-role="button" data-icon="info" data-theme="b" href="#facebook">Fareco renueva su página web  (24/02/2013)</a>
				</div>

			<br />
		<div class="content-primary">	
			<ul data-role="listview">
				
				<li>
					<a data-transition="slideup" href="#nosotros">
						<h3>¿Quiénes somos?</h3>
						<p>Acerca de nosotros</p>
					</a>
				</li>
				
				<li>
					<a data-transition="slideup" href="#asistencia">
						<h3>Multiasistencia</h3>
						<p>¿Problemas urgentes en tu domicilio, negocio o comunidad?</p>
					</a>
				</li>
				
				<li>
					<a data-transition="slideup" href="#reformas">
						<h3>Reformas</h3>
						<p>Tejados, fachadas,...</p>
					</a>
				</li>
				
				<li>
					<a data-transition="slideup" href="#localizacion">
						<h3>Localización</h3>
						<p>¿Quieres saber dónde encontrarnos?</p>
					</a>
				</li>
				
				<li data-theme="b">
					<a data-transition="slideup" href="#contacto">
						<h3>Contacto</h3>
						<p>Consulte sus dudas</p>
					</a>
				</li>
				
			</ul>
		</div><!-- /content-primary -->
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
		<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->

</div><!-- /globalpage -->


<!-- SUBPAGINAS -->

<!-- Quienes somos -->
<div data-role="page" id="nosotros" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Nosotros - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h1>¿Quiénes somos?</h1>
		<p>Somos una empresa dedicada a la realización de <span style="color: #3091f5;">reformas y asistencia urgente del hogar, negocios y comunidades</span>. Contamos con los mejores fontaneros, electricistas, albañiles, cerrajeros, pintores, jardineros y antenistas.</p>
			<ul id="listaquienes">
				<li>Más de 20 años de experiencia en el sector.</li>
				<li>Compromiso de asistencia en un plazo máximo de <span style="color: #3091f5;">48 horas</span>.</li>
				<li>Elaboramos presupuestos personalizados sin compromiso.</li>
			</ul>
			<p>Ponte en contacto con nosotros mediante el formulario de contacto o <span style="color: #3091f5;">llamando al teléfono de contacto</span>. Atención los 7 días de la semana.</p>	
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
			<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>

<!-- Asistencia -->
<div data-role="page" id="asistencia" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Multiasistencia - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h1>Multiasistencia</h1>
		<p style="font-weight: bold;">¿Una gotera en casa? ¿Problemas con la electricidad de tu negocio? ¿Necesitas reparar las tuberías de la comunidad de vecinos?</p>
		<p>Somos exactamente lo que necesitas. Nuestro servicio de asistencia urgente se caracteriza por su eficiencia y rapidez. <span style="color: #3091f5;">Verás atendida tu incidencia en un plazo máximo de 48 horas</span>, siempre con presupuesto aceptado.</p>
		<p>Puedes llamar al <span style="color: #3091f5;">teléfono de contacto de lunes a domingo los 365 días del año</span>. </p>
		<p>Los servicios cubiertos son los siguientes:</p>
		<ul id="listaservicios">
			<li><b>Albañiles:</b> Goteras y humedades.</li>
			<li><b>Cerrajeros:</b> Aperturas de puertas, cierres y vidrios.</li>
			<li><b>Electricistas:</b> Boletines, instalaciones y reparaciones.</li>
			<li><b>Pintores:</b> Interiores y fachadas.</li>
			<li><b>Fontaneros:</b> Agua, gas, calefacción y averías en general.</li>
			<li><b>Limpiezas</b> de viviendas, locales y comunidades.</li>
			<li><b>Carpinteros:</b> Puertas.</li>
			<li><b>Persianas:</b> Instalaciones y reparaciones.</li>
			<li><b>Jardineros:</b> Talas, podas, limpiezas de fincas...</li>
			<li><b>Decoración:</b> Cortinas, papel pintado, corcho,...</li>
			<li><b>Suelos:</b> Moquetas, parqué, tarimas,...</li>
			<li><b>Antenistas:</b> TDT, colectivas, digitales y terrestres.</li>
			<li><b>Aire acondicionado:</b> Instalaciones y reparaciones.</li>
			<li><b>Desatrancos:</b> Arquetas, bajantes y pozos.</li>
		</ul>
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
			<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>

<!-- Reformas -->
<div data-role="page" id="reformas" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Reformas - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h1>Reformas</h1>
		<p style="font-weight: bold;">¿Necesitas reformar tu vivienda o negocio? Nosotros somos la solución.</p>
		<p>Cubrimos todos los municipios del Valle del Tiétar además de Ávila, Madrid y Toledo.</p>
		<p>Contacta con nosotros mediante el formulario de contacto o <span style="color: #3091f5;">llamando al teléfono de contacto</span> y solicita tu presupuesto sin compromiso.</p>
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
			<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>

<!-- Localizacion -->
<div data-role="page" id="localizacion" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Localización - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h1>Localización</h1>
		<p>Si prefieres acercarte a nuestra oficina, estamos localizados en la <span style="color: #3091f5;">Calle Doctor Don Manuel Sánchez nº11-Local (junto a la pescadería "La Ermita"), en Sotillo de la Adrada (Ávila)</span>.</p>
        <p>Nuestro horario de atención al público en la oficina es:<br /><br /> <b>De L a V de 10:00 a 14:00 y de 17:00 a 20:00.</b></p>
		<div class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
			<div id="map_canvas" style="height:350px;"></div>
		</div>
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
			<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>

<!-- Contacto -->
<div data-role="page" id="contacto" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Contacto - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h1>Formulario de contacto</h1>
		<form action="" method="post" data-ajax="false">
			<div id="errorcontacto" style="display: none;">
					<div style="width: 100%; background-color: red; color: white; text-align: center;"><p>Todos los campos deben estar rellenos y el email debe contener una dirección válida.</p></div>
			</div>
			<div data-role="fieldcontain">
			 <label for="nombreform">Nombre:</label>
			 <input type="text" name="nombreform" id="nombreform" value="" />
			</div>

			<div data-role="fieldcontain">
				<label for="statusform" class="select">Status:</label>
				<select name="statusform" id="statusform">
					<option value="cliente">Cliente</option>
					<option value="profesional">Profesional</option>
				</select>
			</div>

			<div data-role="fieldcontain">
			 <label for="emailform">Email:</label>
			 <input type="text" name="emailform" id="emailform" value="" />
			</div>

			<div data-role="fieldcontain">
			 <label for="mensajeform">Mensaje:</label>
			 <textarea cols="40" rows="8" name="mensajeform" id="mensajeform"></textarea>
			</div>
			
			<div>
				<div style="width: 100%;"><button type="submit" id="submit" data-theme="b">Enviar mensaje</button></div>
			</div>
			
			<input type="hidden" id="enviaremail" name="enviaremail" value="0"/>
		</form>
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>

<!-- NOTICIAS -->
<!-- Mejores precios -->
<div data-role="page" id="mejoresprecios" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Novedades - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h2>Novedades</h2>
		<p>El verano es la mejor época del año para llevar a cabo los trabajos en tu vivienda.</p>
		<p><span style="color: #3091f5;">No esperes más para ser la envidia de tus vecinos</span>. Ahora los presupuestos más ajustados y con los mejores acabados.</p>
		<p>¿Todavía lo estás dudando? <span style="color: #3091f5;">¡Llámanos ya!</span>.</p><br/>
		<div style="margin: 0 auto; background:url('http://farm6.staticflickr.com/5473/9464929880_73b72c3610_m.jpg') no-repeat center center; height:180px !important; width:240px !important;"></div>
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
			<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>
<!-- Financiacion -->
<div data-role="page" id="financiacion" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Ofertas - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h2>Ofertón Anticrisis</h2>
		<p>Ahora en Fareco-Multiasistencia <span style="color: #3091f5;">financiamos tus obras</span> y/o reparaciones en 3 meses <span style="color: #3091f5;">sin intereses</span>; y hasta 36 meses si lo prefieres, sea cual sea tu banco.</p>
		<p>Haz la reforma que tanto necesitas sin preocupaciones.</p>
		<p>Para más información pasa por nuestra oficina y te informaremos sin compromiso.</p><br/>
		<div style="margin: 0 auto; background:url('http://farm9.staticflickr.com/8232/8591129771_365920d606_q.jpg') no-repeat center center; height:150px !important; width:150px !important;"></div>
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
			<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>
<!-- Limpmante -->
<div data-role="page" id="limpmante" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Ofertas - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h2>Ofertón Anticrisis</h2>
		<p>Si contratas la <span style="color: #3091f5;">limpieza de tu comunidad</span> con nosotros, te obsequiaremos con <span style="color: #3091f5;">3 meses de mantenimiento de la comunidad gratis</span> en materia de albañilería, fontanería, electricidad o pintura.</p>
		<p>También puedes contratar el <span style="color: #3091f5;">mantenimiento integral del edificio</span>.</p>
		<p>Si tienes cualquier duda o quieres solicitar más información, no dudes en acercarte a nuestra oficina.</p>
		<p><span style="color: #3091f5;">Oferta válida para todo el mes de marzo.</span></p><br/>
		<div style="margin: 0 auto; background:url('http://farm9.staticflickr.com/8233/8514496464_137fe29581_q.jpg') no-repeat center center; height:150px !important; width:150px !important;"></div>
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
			<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>
<!-- Facebook -->
<div data-role="page" id="facebook" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Noticias - Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h2>Últimas Noticias</h2>
		<p>Fareco tiene el placer de hacer oficial su nueva página web.</p>
		<p>A partir de ahora los contenidos serán más accesibles y el website mucho más intuitivo y atractivo.</p>
		<p>Además integramos la web con <a href="http://www.facebook.com/farecomultiasistenciayreformas" target="_blank">nuestra página de Facebook</a>.</p>
		<p>¡Esperamos que os guste!</p><br/>
		<a href="http://www.facebook.com/farecomultiasistenciayreformas" target="_blank">
			<div style="margin: 0 auto; background:url('http://farm9.staticflickr.com/8088/8487567746_f7d43e9404_m.jpg') no-repeat center center; height:71px !important; width:240px !important;"></div>
		</a>
	</div><!-- /content -->
	<div id="telefonos" align="center" style="padding-top: 3%;">
			<div>Teléfono de contacto:<br /><a href="tel:918601167"><img alt="Teléfonos de Fareco S.L. Reformas y Multiasistencia" src="http://fareco-multiasistencia.com/css/images/telefonos.png" /></a></div>
	</div>
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>
<!--FIN NOTICIAS-->

<!-- Confirmar mensaje -->
<div data-role="page" id="dialogsi" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Fareco</h1>
		<a data-transition="slidedown" href="index.php">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h1>¡Mensaje enviado!</h1>
		<p>Gracias por tu interés. Nos pondremos en contacto lo antes posible</p>
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>

<!-- Fallo mensaje -->
<div data-role="page" id="dialogno" class="type-home" data-content-theme="a" data-theme="a">
	<div data-role="header" data-theme="c">
		<h1>Fareco</h1>
		<a data-transition="slidedown" data-rel="back">Volver</a>
	</div><!-- /header -->

	<div data-role="content">	
		<h1>Hubo problemas...</h1>
		<p>El mensaje no se ha podido entregar. Puedes intentarlo de nuevo más tarde. Disculpa las molestias.</p>
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="c" style="text-align: center; padding: 5px 0; clear: both; margin-top: 5%;">Web móvil de Fareco S.L. ® | Designed by <a href="http://sanchezsesena.com" target="_blank">csesena</a></div> <!-- /footer -->
</div>
	
</body>

</html>