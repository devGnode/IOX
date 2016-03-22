<?php

class url{
	
	private $url;
	
	public $get   = NULL;
	public $query = NULL;
	public $path  = NULL;
	public $file  = NULL;
	public $post  = NULL;
	
	//explode data $_GET and $_POST
	// @return Array
	private function explodeData( $data, $_FULL = Array( ) ){
		$ret = [];
		$data = explode("&", $data );
		$len = count( $data );
		$_;
		
		for( $i = 0; $i < $len; $i++ ){
			$_   = explode( "=", $data[ $i ] );
			$_FULL[ $_[0] ] = $_[1]; 		
		}
	return $_FULL;
	}
	//
	
	// __construct
	// @return $this
	public function __construct( $uri ){
		$this->url = $uri;
		
		// if query $_GET
		if( preg_match( "/(.*)(\?.*)/", $uri, $find) ){
			
			$this->path   = $find[ 1 ];
			$this->query  = $find[ 2 ];
			$this->get    = str_replace("?","", $find[ 2 ]);
			
							 
			$_GET = $this->explodeData( $this->get, $_GET );
			
		}
		$this->path = $this->path == NULL ? $uri : $this->path;
		$this->file   = ( preg_match( "/(.+)\/(.+\..+)/", $this->path ) 
						|| preg_match("/\/(.+)\.(.+)/", $this->path ) );	
		
	return $this;
	}
	//
	
	// full Array _GET
	// @return Array $_GET 
	public function _GET( ){
		return ( $_GET = $this->explodeData( $this->get, $_GET ) );
	}
	
	// full Array _POST
	// @return Array $_POST	
	public function _POST( ){
		return ( $_POST = $this->explodeData( $this->post, $_POST ) );
	}
	
	// 
	// @return string extension || false	
	public function getExtension( ){
		if( preg_match( "/(.+)\.(.+)$/", $this->path, $find ) ){
			return $find[2];
		}
	return false;
	}
}

?>