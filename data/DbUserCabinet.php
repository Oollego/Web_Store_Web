<?php
include_once "data/DbData.php";

class DbUserCabinet extends DbData
{

    function __construct() {
        parent::__construct();
    }

    public function Db_ChangeUserName($user_name, $user_surname, $user_id){

        $sql = "UPDATE users SET user_name = ?, surname = ? WHERE users.id = ?;" ;
		try {
            
			$prep = $this->db->prepare($sql);
			$prep->execute([$user_name, $user_surname, $user_id]);
			
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
    }

    public function DbChangeUserAddress($user_address, $user_id){
        $sql = "UPDATE users SET users.address = ? WHERE users.id = ?;" ;
        try {
            
			$prep = $this->db->prepare($sql);
			$prep->execute([$user_address, $user_id]);
			
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
    }

    public function Db_GetUser($user_id){
        $sql = "SELECT users.* FROM users WHERE users.id = ?" ;

        try{
            $prep = $this->db->prepare($sql);
            $prep->execute([$user_id]);
            $row = $prep->fetch() ;
			return $row;
        }
        catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
    }

    public function DbChangeEmailPhone($user_email, $user_phone, $userId){
        $sql = "UPDATE users SET users.email = ?, users.phone = ? WHERE users.id = ?;";

        try {
            
			$prep = $this->db->prepare($sql);
			$prep->execute([$user_email, $user_phone, $userId]);
			
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
    }
    public function DbChangeAvatar($fileName, $userId){
        $sql = "UPDATE users SET users.avatar = ? WHERE users.id = ?;";

        try {
            
			$prep = $this->db->prepare($sql);
			$prep->execute([$fileName, $userId]);
			
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
    }
}