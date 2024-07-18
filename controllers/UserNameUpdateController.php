<?php

include_once "ApiController.php";
include_once "data/DbUserCabinet.php";

class UserNameUpdateController extends ApiController
{

protected function do_post()
	{
		// $result = [ 'get' => $_GET, 'post' => $_POST, 'files' => $_FILES, ] ;
		$result = [  // REST - як "шаблон" однаковості відповідей АПІ
			'status' => 0,
			'meta' => [
				'api' => 'UserName',
				'service' => 'ChangeName',
				'time' => time()
			],
			'data' => [
				'message' => ""
			],
		];
		if (empty($_POST["user-name"])) {
			$result['data']['message'] = "Missing required parameter: 'user-name'";
			$this->end_with($result);
		}
		$user_name = trim($_POST["user-name"]);
		if (strlen($user_name) < 2) {
			$result['data']['message'] = "Validation violation: 'user-name' too short";
			$this->end_with($result);
		}
		if (preg_match('/\d/', $user_name)) {
			$result['data']['message'] =
				"Validation violation: 'user-name' must not contain digit(s)";
			$this->end_with($result);
		}

		if (empty($_POST["user-surname"])) {
			$result['data']['message'] = "Missing required parameter: 'user-surname'";
			$this->end_with($result);
		}
		$userSurname = trim($_POST["user-surname"]);
		if (strlen($userSurname) < 2) {
			$result['data']['message'] = "Validation violation: 'user-surname' too short";
			$this->end_with($result);
		}
		if (preg_match('/\d/', $userSurname)) {
			$result['data']['message'] =
				"Validation violation: 'user-surname' must not contain digit(s)";
			$this->end_with($result);
		}
        $userId = $_SESSION['user']['id'] ;
		try {
						
			(new DbUserCabinet())->Db_ChangeUserName(
				$user_name,
				$userSurname,  $userId
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