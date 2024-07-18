<?php

include_once "ApiController.php";
include_once "data/DbUserCabinet.php";

class AvatarUpdateController extends ApiController
{

	protected function do_post()
	{
        $result = [  // REST - як "шаблон" однаковості відповідей АПІ
			'status' => 0,
			'meta' => [
				'api' => 'userAvatar',
				'service' => 'update',
				'time' => time()
			],
			'data' => [
				'message' => ""
			],
		];

        $filename = null;
		if (!empty($_FILES['user-avatar'])) {
			// файл опціональний, але якщо переданий, то перевіряємо його
			if (
				$_FILES['user-avatar']['error'] != 0
				|| $_FILES['user-avatar']['size'] == 0
			) {
				$result['data']['message'] = "File upload error";
				$this->end_with($result);
			}
			// перевіряємо тип файлу (розширення) на перелік допустимих
			$ext = pathinfo($_FILES['user-avatar']['name'], PATHINFO_EXTENSION);
			if (strpos(".png.jpg.bmp.webp", $ext) === false) {
				$result['data']['message'] = "File type error";
				$this->end_with($result);
			}
			// генеруємо ім'я для збереження, залишаємо розширення
			do {
				$filename = uniqid() . "." . $ext;
			}  // перевіряємо чи не потрапили в існуючий файл
			while (is_file("./wwwroot/avatar/" . $filename));

			// переносимо завантажений файл до нового розміщення
			move_uploaded_file(
				$_FILES['user-avatar']['tmp_name'],
				"./wwwroot/avatar/" . $filename
			);
		}

        $userId = $_SESSION['user']['id'] ;
		try {
			$DbUser = new DbUserCabinet();			
			$DbUser->DbChangeAvatar(
				$filename,
				$userId
			);
            $_SESSION['user'] = $DbUser->Db_GetUser($_SESSION['user']['id']);
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