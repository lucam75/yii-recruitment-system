<?php
/**
*
*/
class EventTranslation
{
	static function missingTranslation($event){

		$mensaje = "";
		$mensaje="{$event->message}";


	  $ar=fopen("traducciones.txt","a") or
	    die("Problemas en la creacion");
	  // fputs($ar,"\n");
	  fputs($ar,"'".$mensaje."'=>'',"."\r\n");
	  // fputs($ar,"\n");
	  // fputs($ar,"\n");
	  fclose($ar);
	  // echo "Los datos se cargaron correctamente.";

	}

}
 ?>