<?php

// Struct header
//
class httpHeaderQuery{
	
	public $method;
	public $uri;
	public $version;
	
	public $options  = Array( );
	public $postData = NULL;
}
class httpHeaderResponse{
	
	public $version     = "HTTP/1.1";
	public $statusCode  = 0x00;
	public $msgCode     = "";

	public $options = Array( );
	public $content = NULL;
}
//

//
class __http__{
	
	// ParseHeader Query
	private static function headParse( $head, $ret ){
		$header = explode( "\r\n", $head );
		
		// review preg_match hack
		preg_match("/(.+) (.+) (.+)/", $header[0], $tmp );
		if( count( $tmp ) <= 1 )
			return false;;
			//MALFORMED QUERY
		
		// HEADER
		if( $ret instanceof httpHeaderQuery ){
			$ret->method = $tmp[1];
			$ret->uri    = $tmp[2];
			$ret->version= $tmp[3];
		}
		if( $ret instanceof httpHeaderResponse ){
			$ret->version    = $tmp[1];
			$ret->statusCode = $tmp[2];
			$ret->msgCode    = $tmp[3];
		}
		
		// Options
		$tmp = [];
		for( $i=1; $i < count( $header ); $i++ ){
			
			preg_match( "/^(.+)\: (.+)/", $header[$i], $tmp );
			if( count( $tmp ) == 3 ){
				$ret->options[ $tmp[1] ] = $tmp[2];
			}
		}
		
		// DATA
		if( strlen( $header[ count( $header )-1 ] ) > 0 ){
			
			if( ($ret instanceof httpHeaderQuery ) ){
				$ret->postData = $header[ count( $header )-1 ];
			}else{
				$ret->content  = $header[ count( $header )-1 ];
			}
			
		}
		
	return $ret;
	}
	
	// parseQuery
	// @return httpHeaderQuery
	public static function parseQuery( $header = "" ){
		return self::headParse( $header, new httpHeaderQuery( ) );
	}
	// parseResponse
	// @return httpHeaderResponse
	public static function parseResponse( $header = "" ){
		return self::headParse( $header, new httpHeaderResponse( ) );
	}
	
	// mount headerResponse
	// @return httpHeaderResponse header
	public static function mountResponse( $status, $msgCode, $options = array( ), $data = NULL ){
		$header = new httpHeaderResponse( );	
		
		$header->statusCode  = $status;
		$header->msgCode   	 = $msgCode;
		$header->options     = $options;
		$header->content     = $data;

	return $header;
	}
	
	// mount headerQuery
	// @return httpHeaderQuery header
	public static function mountQuery( $method, $uri, $options = array( ), $data = NULL ){
		$header = new httpHeaderQuery( );	
		
		$header->method   = $method;
		$header->uri      = $uri;
		$header->version  = "HTTP/1.1";
		$header->options  = $options;
		$header->postData = $data;

	return $header;
	}
	
	//  
	//
	private function rawHeader( $header ){
		$ret = "";
		
		// headerResponse
		if( isset( $header->version ) ){
			$ret .= $header->version." ".
					$header->statusCode." ".
					$header->msgCode."\r\n";
		}else{
			$ret .= $header->method." ".
				    $header->uri." ".
				    $header->version."\r\n";
		}
		
		foreach( $header->options as $option=>$val ){
			$ret .= $option.": ".$val."\r\n";
		}
		$ret .= "\r\n";
		isset( $header->content ) && isset( $header->version ) ? ( $ret .= $header->content != NULL ? $header->content  : "" ) : 0;
		isset( $header->postData ) && isset( $header->method ) ? ( $ret .= $header->postData != NULL ? $header->postData : "" ): 0;
		
	return $ret;
	}
	
	// param : httpHeaderResponse header
	// @reutrn String headerFormat
	public function rawHeaderResponse( $header ){
		return $this->rawHeader( $header );	
	}
	
	// param : httpHeaderQuery header
	// @reutrn String headerFormat
	public function rawHeaderQuery( $header ){
		return $this->rawHeader( $header );		
	}
}


?>