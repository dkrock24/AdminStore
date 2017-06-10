<?php
/*
Copyright 2005 © insidephp@gmail.com

Se otorga el permiso para copiar, distribuir, y/o modificar este programa bajo los términos 
de la Licencia GNU de Documentación Libre (GFDL, GNU Free Documentation License) versión 2 
o posteriores publicadas por la Fundación Software Libre (FSF, Free Software Foundation).

Según esta licencia, cualquier trabajo derivado de esta documentación deberá ser notificado 
al autor, aunque la voluntad del mismo es otorgar la máxima libertad posible. 

Este programa se distribuye con la intención de ser útil, pero SIN NINGUNA GARANTÍA; incluso 
sin la garantía implícita de USABILIDAD o UTILIDAD PARA UN FIN PARTICULAR. Vea la Licencia 
Pública General GNU para más detalles.

Soporte y Updaters: http://insidephp.sytes.net
email: insidephp@gmail.com
*/
//------------------------------------------------------------------------------------------
//  Definiciones


	//  Conexión con la Base de Datos.
	
	$db_server			= "localhost"; 
	$db_name			= "db_global_lapizzeria"; 
	$db_username		= "root"; 
	$db_password		= ""; 


	//  Acceso al script.
	
	$auth_user			= "root";
	$auth_password 	= "";
	$GLOBALS['dbconnection'] = null;


	//  Nombre del archivo.
	$date = date("Y-M-d-h-i-s");

	$filename 			= $date."db_systema_integrado_bk.sql";
	$filename2 			= $date."db_systema_integrado_bk.sql.gz";


//------------------------------------------------------------------------------------------
//  No tocar
	error_reporting( E_ALL & ~E_NOTICE );
	define( 'Str_VERS', "1.1.1" );
	define( 'Str_DATE', "18 de Marzo de 2005" );
//------------------------------------------------------------------------------------------
?>
<?php 
	// Check to see if $PHP_AUTH_USER already contains info
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
		// If empty, send header causing dialog box to appear
		header('WWW-Authenticate: Basic realm="Acceso al Dump y Download la Base de Datos"');
		header('HTTP/1.0 401 Unauthorized');
    // Defines the charset to be used
    header('Content-Type: text/html; charset=iso-8859-1');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Acceso Denegado</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
 </HEAD>
<BODY 
	bgcolor="#D5D5D5" 
	text="#000000" 
	id="all" 
	leftmargin="25" 
	topmargin="25" 
	marginwidth="25" 
	marginheight="25" 
	link="#000020" 
	vlink="#000020" 
	alink="#000020">
	<center><h1>Dump y Download la Base de Datos</h1></center><br>
	<strong><center><p>Usuario/contraseña equivocado. Acceso denegado.</p></center>
<?php
		echo( "</strong><br><br><hr><center><small>" );
		setlocale( LC_TIME,"spanish" );
		echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
		echo( "<br>&copy;2005 <a href=\"mailto:insidephp@gmail.com\">Inside PHP</a><br>" );
		echo( "vers." . Str_VERS . "<br>" );
		echo( "</small></center>" );
		echo( "</BODY>" );
		echo( "</HTML>" );
    exit();
	}
	else {
		if (($_SERVER['PHP_AUTH_USER'] != $auth_user ) || ($_SERVER['PHP_AUTH_PW'] != $auth_password )) {
			header('WWW-Authenticate: Basic realm="Acceso al Dump y Download la Base de Datos"');
			header('HTTP/1.0 401 Unauthorized');
    	// Defines the charset to be used
    	header('Content-Type: text/html; charset=iso-8859-1');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Acceso Denegado</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
 </HEAD>
<BODY 
	bgcolor="#D5D5D5" 
	text="#000000" 
	id="all" 
	leftmargin="25" 
	topmargin="25" 
	marginwidth="25" 
	marginheight="25" 
	link="#000020" 
	vlink="#000020" 
	alink="#000020">
	<center><h1>Dump y Download la Base de Datos</h1></center><br>
	<strong><center><p>Usuario/contraseña equivocado. Acceso denegado.</p></center>
<?php
			echo( "</strong><br><br><hr><center><small>" );
			setlocale( LC_TIME,"spanish" );
			echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
			echo( "<br>&copy;2005 <a href=\"mailto:insidephp@gmail.com\">Inside PHP</a><br>" );
			echo( "vers." . Str_VERS . "<br>" );
			echo( "</small></center>" );
			echo( "</BODY>" );
			echo( "</HTML>" );
    	exit();
		}
		else {
///////  El área protegida empieza DESPUÉS de la SIGUIENTE línea  /////
?>
<?php
//------------------------------------------------------------------------------------------
//  Funciones

	error_reporting( E_ALL & ~E_NOTICE );

	function fetch_table_dump_sql($table, $fp = 0) {
		$tabledump = "--\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "-- Table structure for table `$table`\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "--\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = query_first("SHOW CREATE TABLE $table");
		strip_backticks($tabledump['Create Table']);
		$tabledump = "DROP TABLE IF EXISTS $table;\n" . $tabledump['Create Table'] . ";\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = "--\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "-- Dumping data for table `$table`\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "--\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = "LOCK TABLES $table WRITE;\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$rows = query("SELECT * FROM $table");
		$numfields=mysqli_num_fields($rows);
		while ($row = fetch_array($rows, DBARRAY_NUM)) {
			$tabledump = "INSERT INTO $table VALUES(";
			$fieldcounter = -1;
			$firstfield = 1;
			// campos
			while (++$fieldcounter < $numfields) {
				if( !$firstfield) {
					$tabledump .= ', ';
				}
				else {
					$firstfield = 0;
				}
				if( !isset($row["$fieldcounter"])) {
					$tabledump .= 'NULL';
				}
				else {
					$tabledump .= "'" . mysqli_real_escape_string ($GLOBALS['dbconnection'],$row["$fieldcounter"]) . "'";
				}
			}
			$tabledump .= ");\n";
			if( !$hay_Zlib ) 
				fwrite($fp, $tabledump);
			else
				gzwrite($fp, $tabledump);	
		}
		free_result($rows);
		$tabledump = "UNLOCK TABLES;\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
	}

	function strip_backticks(&$text) {
		return $text;
	}

	function fetch_array($query_id=-1) {
		if( $query_id!=-1) {
			$query_id=$query_id;
		}
		$record = mysqli_fetch_array($query_id);
		return $record;
	}

	function problemas($msg) {
		$errdesc = mysql_error();
    $errno = mysql_errno();
    $message  = "<br>";
    $message .= "- Ha habido un problema accediendo a la Base de Datos<br>";
    $message .= "- Error $appname: $msg<br>";
    $message .= "- Error mysql: $errdesc<br>";
    $message .= "- Error número mysql: $errno<br>";
    $message .= "- Script: ".getenv("REQUEST_URI")."<br>";
    $message .= "- Referer: ".getenv("HTTP_REFERER")."<br>";

		echo( "</strong><br><br><hr><center><small>" );
		setlocale( LC_TIME,"spanish" );
		echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
		echo( "<br>&copy;2005 <a href=\"mailto:insidephp@gmail.com\">Inside PHP</a><br>" );
		echo( "vers." . Str_VERS . "<br>" );
		echo( "</small></center>" );
		echo( "</BODY>" );
		echo( "</HTML>" );
		die("");
  }

	function free_result($query_id=-1) {
    if( $query_id!=-1) {
      $query_id=$query_id;
    }
    return @mysql_free_result($query_id);
  }

  function query_first($query_string) {
    $res = query($query_string);
    $returnarray = fetch_array($res);
    free_result($res);
    return $returnarray;
  }

	function query($query_string) {
    $query_id = mysqli_query($GLOBALS['dbconnection'],$query_string);
    if( !$query_id) {
      problemas("Invalid SQL: ".$query_string);
    }
    return $query_id;
  }


//------------------------------------------------------------------------------------------
//  Main
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
	<title>Dump y Download la Base de Datos</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 </HEAD>
<BODY 
	bgcolor="#D5D5D5" 
	text="#000000" 
	id="all" 
	leftmargin="25" 
	topmargin="25" 
	marginwidth="25" 
	marginheight="25" 
	link="#000020" 
	vlink="#000020" 
	alink="#000020">
<center><h1>Dump y Download la Base de Datos</h1></center>
<br>
<?php
	@set_time_limit( 0 );
	$error = false;
	$tablas = 0;
	$lib = "";
	$conec="";

	if(!@function_exists( 'gzopen' ) ) {
		$hay_Zlib = false;
		 $lib = "Zlib No Disponible";
	}
	else {
		
		$filename = $filename.".gz";
		$hay_Zlib = true;
		 $lib = "Disponible Zlib";
	}
	if( !$error ) { 
	    $GLOBALS['dbconnection'] = mysqli_connect( $db_server, $db_username, $db_password,$db_name ); 

	    if( $GLOBALS['dbconnection']) 
	    	//echo "Conexion Exitosa";
	        //$db = mysql_select_db( $db_name );
	    if( !$GLOBALS['dbconnection'] ) { 
	        //echo( "<br>" );
	        echo $conec = "Conexion Fallida";
	        //echo( "- La conexion con la Base de datos ha fallado: ".mysql_error()."<br>" );
	        $error = true;
	    }
	    else {
	        //echo( "<br>" );
	        echo $conec = "Conexion Exitosa";
	        //echo( "- He establecido conexion con la Base de datos.<br>" );
	    }
	}

?>

<strong>
<?php

	if( !$error ) { 
		//  MySQL versión
		
		$sql = 'SELECT VERSION() AS version';		
		$result = mysqli_query($GLOBALS['dbconnection'],$sql)or die(mysql_error());		
		if( $result != FALSE && mysqli_num_rows($result) > 0 ) {
			$row   = mysqli_fetch_array($result);

		} else {			
			$result = mysqli_query( 'SHOW VARIABLES LIKE \'version\'' );
			if( $result != FALSE && mysqli_num_rows($result) > 0 ){
				$row   = mysqli_fetch_row( $result );
			}
		}
		if(! isset($row) ) {
			$row['version'] = '3.21.0';

		}

	}

	if( !$error ) { 
		$el_path = getenv("REQUEST_URI");
		$el_path = substr($el_path, strpos($el_path, "/"), strrpos($el_path, "/"));

$sql = "SHOW TABLES FROM $db_name";
$result = mysqli_query($GLOBALS['dbconnection'],$sql);



		if (!$result) {
		    echo "DB Error, could not list tables\n";
		    echo 'MySQL Error: ' . mysql_error();
		    exit;
		}

		else {
			$t_start = time();
			
			if( !$hay_Zlib ) 
				$filehandle = fopen( $filename, 'w' );
			else
				$filehandle = gzopen( $filename, 'w6' );	//  nivel de compresión
				
			if( !$filehandle ) {
				$el_path = getenv("REQUEST_URI");
				$el_path = substr($el_path, strpos($el_path, "/"), strrpos($el_path, "/"));
				//echo( "<br>" );
				//echo( "- No he podido crear '$filename' en '$el_path/'. Por favor, asegúrese de<br>" );
				//echo( "&nbsp;&nbsp;que dispone de privilegios de escritura.<br>" );
			}
			else {
				$desactivar_llaves = "SET FOREIGN_KEY_CHECKS=0; \n";					
				$tabledump = "-- Dump de la Base de Datos\n";
				fwrite($filehandle, $desactivar_llaves);
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				setlocale( LC_TIME,"spanish" );
				$tabledump = "-- Fecha: " . strftime( "%A %d %B %Y - %H:%M:%S", time() ) . "\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "--\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Version: " . Str_VERS . ", del " . Str_DATE . ", insidephp@gmail.com\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Soporte y Updaters: http://insidephp.sytes.net\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "--\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Host: `$db_server`    Database: `$db_name`\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- ------------------------------------------------------\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Server version	". $row['version'] . "\n\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	

				$result = query( 'SHOW tables' );
				while( $currow = fetch_array($result, DBARRAY_NUM) ) {
					fetch_table_dump_sql( $currow[0], $filehandle );
					fwrite( $filehandle, "\n" );
					if( !$hay_Zlib ) 
						fwrite( $filehandle, "\n" );
					else
						gzwrite( $filehandle, "\n" );
						$tablas++;
				}
				$tabledump = "\n-- Dump de la Base de Datos Completo.";

				$activacion_llaves = "\n SET FOREIGN_KEY_CHECKS=1;";
				fwrite($filehandle, $activacion_llaves);

				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				if( !$hay_Zlib ) 
					fclose( $filehandle );
				else
					gzclose( $filehandle );
	
				$t_now = time();
				$t_delta = $t_now - $t_start;
				if( !$t_delta )
					$t_delta = 1;
				$t_delta = floor(($t_delta-(floor($t_delta/3600)*3600))/60)." minutos y "
				.floor($t_delta-(floor($t_delta/60))*60)." segundos.";
				//echo( "- He salvado las $tablas tablas en $t_delta<br>" );
				//echo( "<br>" );
				//echo( "- El Dump de la Base de Datos está completo.<br>" );
				//echo( "- He salvado la Base de Datos en: $el_path/$filename<br>" );
				//echo( "<br>" );
				//echo( "- Puede bajársela directamente: </strong><a href=\"$filename\">$filename</a>" );
				$size = filesize($filename);
				$size = number_format( $size );
				$size = str_replace( ",",".",$size );
				//echo( "&nbsp;&nbsp;&nbsp;<small>($size bytes)</small><br>" );
			}
		}
	}
?>



        <div class="row">
        	<div class="col-md-1"></div>
        	<div class="col-md-10">
        		<table class="table">
        		<tr>
             		<td>Conexion</td>
             		<td><?php echo $conec;  ?></td>
             		<td>Servidor</td>
             		<td><?php echo $db_server ;  ?></td>
             	</tr>
             	<tr>
             		<td>Base de Datos</td>
             		<td><?php echo $db_name;  ?></td>
             		<td>Servidor</td>
             		<td><?php echo $db_server ;  ?></td>
             	</tr>
             	<tr>
             		<td>Libreria Cargada</td>
             		<td><?php echo $lib;  ?></td>
             		<td>Nombre del BK</td>
             		<td><?php echo $filename ;  ?></td>
             	</tr>
             	<tr>
             		<td>Tablas Salvadas</td>
             		<td><?php echo $tablas;  ?></td>
             		<td>Tiempo</td>
             		<td><?php echo $t_delta ;  ?></td>
             	</tr>
             	<tr>             		
             		<td colspan="4"><?php if($t_delta){ echo "El Dump de la Base de Datos está completo";}  ?></td>
             	</tr>
             	<tr>             		
             		<td colspan="4"><?php if($t_delta){ echo "He salvado la Base de Datos en: $el_path/$filename";}  ?></td>
             	</tr>
             	<tr>             		
             		<td colspan="4"><?php if($t_delta){ echo "Puede bajársela directamente: </strong><a href= $el_path/$filename>$filename</a>";} echo( "&nbsp;&nbsp;&nbsp;<small>($size bytes)</small><br>" );  ?></td>
             	</tr>
             	</table>
        	</div>
        	<div class="col-md-1"></div>             
        </div>

<?php
	$date = date("Y-m-d h:i:s");
	$sql = "insert into log_backups (nombre_bk,fecha_bk,link_bk)values('".$filename."','".$date."','".$filename2."')";
	
	mysqli_query($GLOBALS['dbconnection'],$sql).die(mysql_error());

	if( $GLOBALS['dbconnection'] )
	    mysql_close();

	echo( "</strong><br><br><hr><center><small>" );
	setlocale( LC_TIME,"spanish" );
	echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
	echo( "<br>&copy;2015 <a href=\"mailto:rgutierreztejada@gmail.com\">Inside PHP</a><br>" );
	echo( "vers." . Str_VERS . "<br>" );
	echo( "</small></center>" );
	echo( "</BODY>" );
	echo( "</HTML>" );
	
//------------------------------------------------------------------------------------------
//  END
?>


<?php
///////  El área protegida acaba ANTES de la ANTERIOR línea  /////
		}
	}
?>

