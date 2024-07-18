<?php

include_once "ApiController.php";
include_once "data/DbUserCabinet.php";

class AddressUpdateController extends ApiController
{

	protected function do_post()
	{
        $result = [  // REST - як "шаблон" однаковості відповідей АПІ
			'status' => 0,
			'meta' => [
				'api' => 'userAddress',
				'service' => 'update',
				'time' => time()
			],
			'data' => [
				'message' => ""
			],
		];

				
		if (empty($_POST["user_address"])) {
			$result['data']['message'] = "Missing required parameter: 'user-address'";
			$this->end_with($result);
		}
		$user_address = trim($_POST["user_address"]);
		if (strlen($user_address) < 10) {
			$result['data']['message'] = "Validation violation: 'user-address' too short";
			$this->end_with($result);
		}

        $userId = $_SESSION['user']['id'] ;
		try {
						
			(new DbUserCabinet())->DbChangeUserAddress(
				$user_address,
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