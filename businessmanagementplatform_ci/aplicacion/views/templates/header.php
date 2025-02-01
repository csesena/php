<?php header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Europe/Madrid'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
	<title>MC - <?php echo $title ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="lang" content="es" />
		
	<link rel="shortcut icon" href="css/images/favicon.ico"/>

	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Ubuntu'/>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.0/themes/trontastic/jquery-ui.css"/>
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	<script type="text/javascript" src="js/comboboxes.js"></script>
	<script type="text/javascript">
		$(function() {
			$( ".combobox" ).combobox();
			$( "#toggle" ).click(function() {
				$( ".combobox" ).toggle();
			});
		});
	</script>
</head>
<body>
	<div id="header">
	</div> <!-- Header -->
	<div id="supercontainer">
		<div id="wrapper">
			<div id="container">