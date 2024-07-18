<?php
class ApiController {
	
	public function serve(){
		$method = strtolower( $_SERVER[ 'REQUEST_METHOD' ] ) ;
		$action = "do_{$method}" ;
		if( method_exists( $this, $action ) ) {
			$this->$action() ;
		}
		else{
			http_response_code( 405 ) ;
			echo "Method Not Allowed" ;
		}
		
	}
	
	protected function connect_db_or_exit() {
		try {
			return new PDO(
			'mysql:host=localhost;dbname=php_store;charset=utf8mb4', 
			'store_user', 'store_pass', [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			] ) ;
			
			
			} 
			catch (PDOException $e) {
				http_response_code( 500 ) ;
				echo "Connection error: " . $e->getMessage();
				exit ;
			}
	}
	
	protected function end_with( $result ) {
		header_remove();
		http_response_code(200);
		//header('Content-Type: application/json; charset=utf-8');
		header_remove('Transfer-Encoding');
		header('Content-Type: application/json');
		echo json_encode ($result) ;
		exit ;
	}
}

//nachinaetsya s indexa