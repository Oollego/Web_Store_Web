<?php

include_once "ApiController.php" ;

class TestController extends ApiController{

// 	protected function do_get(){
// 		$db = $this->connect_db_or_exit() ;
		
// 		$sql = "CREATE TABLE IF NOT EXISTS Users (
// 			`id` CHAR(36) PRIMARY KEY DEFAULT ( UUID() ),
// 			`email` VARCHAR(128) NOT NULL,
// 			`name`  VARCHAR(64) NOT NULL,
// 			`password` CHAR(32) NOT NULL COMMENT 'Hash of password',
// 			`avatar` VARCHAR(128) NULL
// 			) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4";
// 		try{
// 			$db->query( $sql );
// 		}
// 		catch( PDOException $ex ) {
// 			http_response_code( 500 ) ;
// 			echo "qdom_error: " . $ex->getMessage() ;
// 			exit ;
// 		}

// 		echo "Hello from do_get - Query OK" ;
// 	}		
// /* 	На кнопку POST в тестовому API реалізувати створення 
// таблиці-журналу реєстрації ( id, date-time, user-id, token[Hash] ) */
// 	protected function do_post(){
// 		$db = $this->connect_db_or_exit() ;
		
// 		$sql = " CREATE TABLE IF NOT EXISTS RegistrLog (
// 		`id` CHAR(36) PRIMARY KEY DEFAULT ( UUID() ),
// 		`date` DATETIME NOT NULL,
// 		`userId` CHAR(36) NOT NULL,
// 		`token` VARCHAR(36) NOT NULL,
// 		 FOREIGN KEY (userId) REFERENCES Users(id)
// 		) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4" ;
		
// 		try{
// 			$db->query( $sql );
// 		}
// 		catch( PDOException $ex ) {
// 			http_response_code( 500 ) ;
// 			echo "qdom_error: " . $ex->getMessage() ;
// 			exit ;
// 		}
		
// 		echo "Hello from post - Query OK" ;
// 	}		
}