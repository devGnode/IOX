<?php
//
class webSocket{
	
		public  $msock = null;
		public  $user  = array( );
		public  $socks = array( );
		
		public function __construct( $host, $port ){
			
			// Create socket TCP
			ini_set('default_socket_timeout', 10);
			$this->msock = socket_create( 
				AF_INET,
				SOCK_STREAM,
				SOL_TCP
				);
			socket_set_option( 
				$this->msock,
				SOL_SOCKET,
				SO_REUSEADDR,
				1
			);
			socket_bind( 
				$this->msock,
				$host,
				$port
			);
			array_push( $this->socks, $this->msock );
			
			console::log("_webSocket : socket created with successfull.");
			console::log("_webSocket : ".$this->msock );
			console::log("_webSocket : ".$host." / ".$port);
		}
		
		//
		// @return bool
		public function listen( ){
			return socket_listen( $this->msock, 0xffff );
		}
		
		// param : RESSOURCE socket
		// @return bool
		public function accept( $sock = NULL ){
			return socket_accept( $sock );
		}
}

?>
