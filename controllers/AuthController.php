<?php

include_once "ApiController.php";
include_once "data/DbData.php";

class AuthController extends ApiController
{

	protected function do_get()
	{
		
		
		try {
			(new DbData()) ->CreateUsers();
			//$db->query($sql);
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
		echo "Hello from do_get - Query OK";
	}

	/**
	 * Реєстрація нового користувача (Create)
	 */
	protected function do_post()
	{
		// $result = [ 'get' => $_GET, 'post' => $_POST, 'files' => $_FILES, ] ;
		$result = [  // REST - як "шаблон" однаковості відповідей АПІ
			'status' => 0,
			'meta' => [
				'api' => 'auth',
				'service' => 'signup',
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

		if (empty($_POST["user-password"])) {
			$result['data']['message'] = "Missing required parameter: 'user-password'";
			$this->end_with($result);
		}
		$user_password = $_POST["user-password"];

		if (empty($_POST["user-email"])) {
			$result['data']['message'] = "Missing required parameter: 'user-email'";
			$this->end_with($result);
		}
		$user_email = trim($_POST["user-email"]);

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
		/* Запити до БД поділяються на два типи - звичайні та підготовлені
		У звичайних запитах дані підставляються у текст запиту (SQL), 
		у підготовлених - ідуть окремо.
		Звичайні запити виконуються за один акт комунікації (БД-РНР),
		підготовлені - за два: перший запит "готує", другий передає дані.
		!! Хоча підготовлені запити призначені для повторного (багаторазового)
			використання, вони мають значно кращі параметри безпеки щодо 
			SQL-ін'єкцій.
			... WHERE name='%s' ...   (name = "o'Brian") -> 
			... WHERE name='o'Brian' ...  -- пошкоджений запит (Syntax Error)
		  Тому використання підготовлених запитів рекомендується у всіх 
		  випадках, коли у запит додаються дані, що приходять зовні
		*/
		//$db = $this->connect_db_or_exit();
		
		//$sql = "INSERT INTO Users(`email`,`name`,`password`,`avatar`) VALUES(?,?,?,?) ";

		try {
			// $prep = $db->prepare($sql);  // 2. Запит готується
			// // 3. Запит виконується з передачею параметрів
			// $prep->execute([
			// 	$user_email,
			// 	$user_name,
			// 	md5($user_password),
			// 	$filename
			// ]);
			
			(new DbData())->CreateUser([
				$user_email,
				$user_name,
				md5($user_password),
				$filename
			]);
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}

		$result['status'] = 1;
		$result['data']['message'] = "Signup OK";
		$this->end_with($result);
	}

	/**(Read)*/
	protected function do_patch()
	{
		$result = [  // REST - як "шаблон" однаковості відповідей АПІ
			'status' => 0,
			'meta' => [
				'api' => 'auth',
				'service' => 'authentication',
				'time' => time()]
// 			,
// 			'data' => [
// 				'message' => $_GET
// 			],
		];
		if (empty($_GET["email"])) {
			$result['data']['message'] = "Missing required parameter: 'email'";
			$this->end_with($result);
		}
		$email = trim($_GET["email"]);

		if (empty($_GET["password"])) {
			$result['data']['message'] = "Missing required parameter: 'password'";
			$this->end_with($result);
		}
		$password = $_GET["password"];

		// $db = $this->connect_db_or_exit();
		//$sql = "SELECT * FROM Users u WHERE u.email = ? AND u.password = ?";
		try {
			// $prep = $db->prepare($sql);
			// $prep->execute([$email, md5($password)]);
			// $res = $prep->fetch();   // або false або масив
			//$result[ 'data' ][ 'message' ] =  var_export( $res, true ) ;
		
			$res = (new dbData())->UserAuthChecker($email, $password);
			if ($res === false) {
				$result['data']['message'] = "Credentials rejected";
				$this->end_with($result);
			}
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
		//session
		@session_start();
		$_SESSION['user'] = $res;
		$_SESSION['auth-moment'] = time();


		$result['status'] = 1;
		$result['id'] = $res['id'];
		$result['avatar'] = $res['avatar'];

		$this->end_with($result);
	}


	protected function do_delete()
	{
		
		$result = [  // REST - як "шаблон" однаковості відповідей АПІ
			'status' => 0,
			'meta' => [
				'api' => 'auth',
				'service' => 'signout',
				'time' => time()
			],
			'data' => [
				'message' => ""
			],
		];
		@session_start();
		
		if ( isset( $_SESSION[ 'user' ]) ){
			session_destroy();
			$result['status'] = 1;
		}
		else{
			$result['data']['message'] = "You don't have authorization ";
		}
		
		$this->end_with($result);
	}
}
/*
CRUD-повнота -- реалізація щонайменше 4х операцій з даними
C  Create   POST
R  Read     GET
U  Update   PUT
D  Delete   DELETE

Д.З. Закласти курсовий проєкт
- скласти ТЗ (хоча б мінімалістичне), орієнтир часу на весь проєкт - 4 тижні
- створити облікові записи
 = репозиторій
 = місце розміщення 
- створити стартову сторінку
Прикласти посилання на репозиторій та сам сайт

*/
