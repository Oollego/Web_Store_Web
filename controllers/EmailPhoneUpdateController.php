<?php

include_once "ApiController.php";
include_once "data/DbUserCabinet.php";

class EmailPhoneUpdateController extends ApiController
{

protected function do_post()
	{
		// 
		$result = [  
			'status' => 0,
			'meta' => [
				'api' => 'PhoneEmailUpDate',
				'service' => 'Update',
				'time' => time()
			],
			'data' => [
				'message' => ""
			],
		];
		
		if (empty($_POST["user-email"])) {
			$result['data']['message'] = "Missing required parameter: 'user-email'";
			$this->end_with($result);
		}
        $user_email = trim($_POST["user-email"]);
        if(!(preg_match('/^(\w+)@(\w+)\.(\w)/', $user_email))){
            $result['data']['message'] = "Parameter 'user-email' is not correct";
			$this->end_with($result);
        }
		
        if (empty($_POST["user-phone"])) {
			$result['data']['message'] = "Missing required parameter: 'user-phone'";
			$this->end_with($result);
		}
        $user_phone =trim($_POST["user-phone"]);
        if (!(preg_match('/\d{6}/', $user_phone))) {
			$result['data']['message'] =
				"Validation violation: 'user_phone' must contain at list 6 digits";
			$this->end_with($result);
		}

		
		
        $userId = $_SESSION['user']['id'] ;
		try {
						
			(new DbUserCabinet())->DbChangeEmailPhone(
				$user_email,
				$user_phone,  
                $userId
			);
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}

		$result['status'] = 1;
		$result['data']['message'] = "Name changed";
		$this->end_with($result);
	}
}