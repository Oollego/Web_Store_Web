 <!-- <?php

include_once "ApiController.php" ;

class AuthController extends ApiController{
	
	

	// protected function do_get(){
	// 	$db = $this->connect_db_or_exit() ;
		
	// 	$sql = "CREATE TABLE IF NOT EXISTS Users (
	// 		`id` CHAR(36) PRIMARY KEY DEFAULT ( UUID() ),
	// 		`email` VARCHAR(128) NOT NULL,
	// 		`name`  VARCHAR(64) NOT NULL,
	// 		`password` CHAR(32) NOT NULL COMMENT 'Hash of password',
	// 		`avatar` VARCHAR(128) NULL
	// 		) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4";
	// 	try{
	// 		$db->query( $sql );
	// 	}
	// 	catch( PDOException $ex ) {
	// 		http_response_code( 500 ) ;
	// 		echo "qdom_error: " . $ex->getMessage() ;
	// 		exit ;
	// 	}

	// 	echo "Hello from do_get - Query OK" ;
	// }		
/* 	На кнопку POST в тестовому API реалізувати створення 
таблиці-журналу реєстрації ( id, date-time, user-id, token[Hash] ) */
	// protected function do_post(){
		
	// 	$result = [
	// 	'status' => 0,
	// 	'meta' => [
	// 		'api' => 'auth',
	// 		'service' => 'signup',
	// 		'time' => time()
	// 	],
	// 		'data' => [
	// 			'message' => ""
	// 		],
	// 	];
	// 	if( empty( $_POST["user-name"] ) ){
	// 		$result[ 'data' ][ 'message' ] = "Missing required parameter: 'user-name'" ;
	// 		$this->end_with( $result ) ;
	// 	}
	// 	$user_name = trim ( $_POST[ "user-name" ] ) ;
	// 	if( strlen ( $user_name ) < 2 ) {
	// 		$result[ 'data' ][ 'message' ] = "Validation violation: 'user-name' to short";
	// 		$this->end_with( $result ) ;
			
	// 	}
		// if( preg_match( '/\d/', $user_name ) ){
		// 	$result[ 'data' ][ 'message' ] = "Validation violation: 'user-name' must not contain digit(s)" ;
		// 	$this->end_width ( $result ) ;
		// }
		// if ( empty( $_FILES[ 'user-password' ] ) ) {
		// 	$result[ 'data' ][ 'message' ] = "Missing required parameter: 'user-password'" ;
		// 	$this->end_width ( $result ) ;
		// }
	// 	$user_password = $_POST[ "user-password" ];
		
	// 	$filename = null ;
		
	// 		if( $_FILES[ 'user-avatar' ][ 'error' ] != 0
	// 		|| $_FILES[ 'user-avatar' ][ 'size' ] == 0){
	// 			$result[ 'data' ][ 'message' ] = "File upload error" ;
	// 			$this->end_with ( $result ) ;
	// 		}
			
			
			
	// 		$ext = pathinfo( $_FILES[ 'user-avatar' ][ 'name' ], PATHINFO_EXTENSION ) ;
	// 		if( strpos( ".png.jpg.bmp", $ext ) == -1 ){
				
	// 			$$result[ 'data' ][ 'message' ] = "File type error" ;
	// 			$this->end_with( $result ) ;
	// 		}
		
	// 		do {
	// 			$filename = uniqid() . "." . $ext ;
	// 		}
	// 		while( is_file( "./wwwroot/avatar/" . $filename ) ) ;
			
	// 		move_uploaded_file( 
	// 		$_FILES[ 'user-avatar' ][ 'tmp_name' ],
	// 		"./wwwroot/avatar/" . $filename ) ;
			
		
	// 		$db = $this->connect_db_or_exit() ;
			
	// 		$sql = "INSERT INTO Users(`email`, `name`, `password`, `avatar`) VALUES(?,?,?,?) ";
			
			
			
	// 		try{
	// 			$prep = $db->prepare( $sql ) ;
	// 			$prep->execute( [
	// 				$user_email,
	// 				$user_name,
	// 				md5( $user_password ),
	// 				$filename
	// 			] ) ;
	// 		}
	// 		catch( PDOException $ex ) {
	// 			http_response_code( 500 ) ;
	// 			echo "qdom_error: " . $ex->getMessage() ;
	// 			exit ;
	// 		}

					
	// 		$result[ 'status' ] = 1 ;
	// 		$result[ 'data' ][ 'message' ] = "Signup OK"  ;
	// 			$this->end_with( $result ) ;
				 
	// }


} 