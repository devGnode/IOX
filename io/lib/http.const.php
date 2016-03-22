<?php

// const Status code 
// protocol HTTP

const ST_CONTINUE 		 = 100;
const ST_SWITCH_PROTOCOL = 101;
const ST_PROCESSING		 = 102;

// success 
const ST_OK		 = 200;
const ST_CREATE	 = 201;
const ST_ACCEPT  = 202;

// client 
const ST_BAD_REQ    = 400;
const ST_UNHAUTH    = 401;
const ST_PAYMENTREQ = 402;
const ST_FORBIDDEN  = 403;
const ST_NOTFOUND   = 404;	
const ST_NOTALLOWED = 405;
const ST_REQTIMEOUT = 408;

// sevrer
const ST_INTERNAL_SERVER_ERROR  = 500;
const ST_BAD_GATEWAY			= 502;
const ST_GATEWAY_TIMEOUT		= 504;

?>