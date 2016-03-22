# socket.lib

```php
  $__sock__ = new webSocket( string ip, int port );
```
> return 
```php
  webSocket => ( 
    msock   =>  RESSOURCE socket,
    user    => Array( void ),
    socks   => Array( void ),
    // Method
    listen 
    accept
  );
```

# http.lib

```php
  $__http__ = new __http__(  );
```
> return 
```php
  // static
  __http__::parseQuery( string Header ); // @return 
  httpHeaderQuery => ( 
    method   =>  string method,
    uri      => string uri,
    version  => string version,
    options  => array options,
    postData => string postData
  );
  httpHeaderQuery => ( 
    method   =>  "GET",
    uri      => "/index.html",
    version  => "HTTP/1.1",
    options  => array("Connection" => "Close", "Cookies" => "foo=bar;bar=foo" ),
    postData => NULL
  );
```
```php
 __http__::parseResponse( string Header ); // @return 
  httpHeaderQuery => ( 
    version    =>  string version,
    statusCode => string statusCode,
    msgCode    => string msgCode,
    options  => array options,
    content  => string content
  );
  httpHeaderQuery => ( 
    version    => "HTTP/1.1",
    statusCode => "404",
    msgCode    => "NOT FOUND",
    options    => array("Connection" => "Close" ),
    content    => "<b>Not found</b>"
  );
```

Fabriquer une réponse ( server ) :
```php
  __http__::mountResponse( 
    int StatusCode,
    string msgCode,
    Array  optionsHeader,
    string Data
  );
  __http__::mountResponse( 200, "OK", array( "Connection" => "Kepp-Alive" ), "<b>Hello World !</b>" );
  httpHeaderResponse => ( 
    version     =>  "HTTP/1.1",
    statusCode  => 200,
    msgCode     => "OK",
    options     => array( "Content-Type" => "text/html", "Connection" => "Kepp-Alive" ),
    data        => "<b>Hello World !</b>"
  );
  
```

```php
  $__http__->rawHeaderResponse( 
    httpHeaderResponse header
  );
  HTTP/1.1 200 OK\r\n
  Content-Type: text/html\\n
  Connection: Kepp-Alive\r\n
  \r\n
  <b>Hello World !</b>
```
Fabriquer une réponse ( server ) :
```php
  __http__::mountQuery( 
      string method,
      string uri,
      array options,
      string postData
  );
  __http__::mountResponse( "POST", "/", 
    array( "Connection" => "Kepp-Alive", "Content-type"... ), "uid=12&time=0" );
  httpHeaderQuery => ( 
    method   =>  "POST",
    uri      => "/",
    version  => "HTTP/1.1",
    options  => array( "Connection" => "Kepp-Alive", "Content-type"... ),
    postData => "uid=12&time=0"
  );
  
```

```php
  $__http__->rawHeaderResponse( 
    httpHeaderQuery header
  );
  POST / HTTP/1.1\r\n
  Content-Type: application/x-www-form-urlencoded\\n
  Connection: Kepp-Alive\r\n
  \r\n
  uid=12&time=0
```


# url.lib

```php
  $__url__ = new url( String $uri );
```
> return 
```php
  url => ( 
    get   => string,
    query => string,
    path  => string,
    file  => bool,
    post  => string
    // Method
    _GET 
    _POST
    getExtension
  );
```
```php
  $url = new url('/foo/index.php?id=2');
  => ( 
    get   => "id=2",
    query => "?id=2",
    path  => "/foo/index.php",
    file  => 1,
    post  => NULL
  );
  $url->getExtension( ) // @return php
```
```php
  $url->_GET( ); // @return
  => ( 
    id   => 2,
  );
```
```php
  $url->post = "foo=bar&test=25"
  $url->_POST( ); // @return
  => ( 
    foo   => bar,
    test  => 25
  );
```
