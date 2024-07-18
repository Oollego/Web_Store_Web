<?php
header( "Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS" ) ;

 if( isset( $_SERVER[ 'HTTP_ACCESS_CONTROL_REQUEST_HEADERS' ] ) )
     header( "Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}" ) ;

 header( 'Access-Control-Allow-Origin: *' ) ;


$uri = $_SERVER['REQUEST_URI'] ;

$pos = strpos( $uri, '?' ) ;
if( $pos > 0 ) {
	$uri = substr( $uri, 1, $pos - 1 ) ;
}
else{
	$uri = substr( $uri, 1 );
}




if( $uri != "" ) {
	

	$filename = "./wwwroot/{$uri}" ;
	// без зазначення типу контенту файли можуть бути ігноровані
	// а також з метою обмеження прямого доступу до деяких файлів
	// аналізуємо розширення файлу
	if( is_readable( $filename ) ) {   // запит URI - існуючий файл
		$ext = pathinfo( $filename, PATHINFO_EXTENSION ) ;
	// echo $ext ; exit ;
		unset( $content_type ) ;
		switch( $ext ) {
			case 'png': 
			case 'bmp':
			case 'gif': 
			case 'webp':
				$content_type = "image/{$ext}" ; break ;
			case 'jpg':
			case 'jpeg':
				$content_type = "image/jpeg" ; break ;
			case 'js':
				$content_type = "text/javascript" ; break ;
			case 'css':
			case 'html':
				$content_type = "text/{$ext}" ; break ;
		}
		if( isset( $content_type ) ) {
			header( "Content-Type: {$content_type}" ) ;			
			readfile( $filename ) ;   // передає тіло файлу до НТТР-відповіді
		}
		else {
			http_response_code( 404 ) ;
			echo "Not found" ;
		}
		exit ;   // кінець роботи РНР скрипта (повний вихід)
		
		
	}
	
	if(substr_count($uri, 'group_') > 0){
		$pos = strpos($uri ,"_", 1);
		$contentUri = substr( $uri, $pos + 1, strlen($uri) ) ;
		$uri = 'group' ;
	}
	if(substr_count($uri, 'item_') > 0){
		$pos = strpos($uri ,"_", 1);
		$contentUri = substr( $uri, $pos + 1, strlen($uri) ) ;
		$uri = 'item' ;
	}
}
//$contentUri = substr( $uri, $slashPos + 1, strlen($uri) ) ;
//$uri = substr( $uri, 0, $pos ) ;

$routes = [
	''       => 'index.php',
	'signup' => 'signup.php',
	'api'    => 'api.php',
	'group' => 'group_item.php',
	'stores' => 'stores_view.php',
	'items'	=> 'items.php',
	'basketview' => 'basketview.php',
	'item' => 'itemview.php'
] ;
session_start();

 if ( isset( $_SESSION[ 'user' ]) ){
	$userRoutes = [
		'cabinet' => 'cabinet.php',
		'orders' => 'orders.php',
		'basketviewcab' => 'basketviewcab.php'	
	] ;
	$routes = array_merge ($routes, $userRoutes);
}

$itemsTempArr = [];

if( isset( $routes[ $uri ] ) ) {   // у маршрутах є відповідний запис
	$page_body = $routes[ $uri ] ;
	include '_layout.php' ;
}
if($uri == "checkout"){
	include 'checkout.php' ;
}
else {	
	$uri_name = ucfirst($uri) ;
	$controller_name = "{$uri_name}Controller";
	$controller_path = "./controllers/{$controller_name}.php";
		if( is_readable( $controller_path ) ) {
			
			include  $controller_path ;
			$controller_object = new $controller_name() ;
			$controller_object -> serve() ;
		}
		else {
			echo "uri not found" ;
		}
}


 