<?php

class console{
	public static function log( $msg ){
		switch( getType( $msg ) ){
			case "ressource":
			case "object":
			case "array":
				print_r( $msg );
			break;
			case "string":
			case "interger":
			case "double":
			default:
				print($msg."\r\n");
			break;			
		}		
	}
}

?>
