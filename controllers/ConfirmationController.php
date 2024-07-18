<?php

include_once "ApiController.php";
include_once "data/DbOrders.php";


class confirmationController extends ApiController
{

protected function do_post()
	{
		// 
		$result = [  
			'status' => 0,
			'meta' => [
				'api' => 'Confirmation',
				'service' => 'Order',
				'time' => time()
			],
			'data' => [
				'message' => ""
			],
		];
		
		if (empty($_POST["checkout-name"])) {
			$result['data']['message'] = "Missing required parameter: 'checkout-name'";
			$this->end_with($result);
		}
		$checkout_name = trim($_POST["checkout-name"]);
		if (strlen($checkout_name) < 2) {
			$result['data']['message'] = "Validation violation: 'checkout-name' too short";
			$this->end_with($result);
		}
		if (preg_match('/\d/', $checkout_name)) {
			$result['data']['message'] =
				"Validation violation: 'checkout-name' must not contain digit(s)";
			$this->end_with($result);
		}

		if (empty($_POST["checkout-surname"])) {
			$result['data']['message'] = "Missing required parameter: 'checkout_surname'";
			$this->end_with($result);
		}
		$checkout_surname = trim($_POST["checkout-surname"]);
		if (strlen($checkout_surname) < 2) {
			$result['data']['message'] = "Validation violation: 'checkout_surname' too short";
			$this->end_with($result);
		}
		if (preg_match('/\d/', $checkout_surname)) {
			$result['data']['message'] =
				"Validation violation: 'checkout_surname-surname' must not contain digit(s)";
			$this->end_with($result);
		}

		if (empty($_POST["checkout-email"])) {
			$result['data']['message'] = "Missing required parameter: 'checkout-email'";
			$this->end_with($result);
		}
        $checkout_email = trim($_POST["checkout-email"]);
        if(!(preg_match('/^(\w+)@(\w+)\.(\w)/', $checkout_email))){
            $result['data']['message'] = "Parameter 'checkout-email' is not correct";
			$this->end_with($result);
        }
		
        if (empty($_POST["checkout-phone"])) {
			$result['data']['message'] = "Missing required parameter: 'user-phone'";
			$this->end_with($result);
		}
        $checkout_phone =trim($_POST["checkout-phone"]);
        if (!(preg_match('/\d{6}/', $checkout_phone))) {
			$result['data']['message'] =
				"Validation violation: 'checkout_phone' must contain at list 6 digits";
			$this->end_with($result);
		}

        if (empty($_POST["checkout-address"])) {
			$result['data']['message'] = "Missing required parameter: 'checkout-address'";
			$this->end_with($result);
		}
		$checkout_address = trim($_POST["checkout-address"]);
		if (strlen($checkout_address) < 10) {
			$result['data']['message'] = "Validation violation: 'checkout-address' too short";
			$this->end_with($result);
		}
        if (empty($_POST["checkout-shipment"])) {
			$result['data']['message'] = "Missing required parameter: 'checkout-shipment'";
			$this->end_with($result);
		}
        if (empty($_POST["checkout-payment"])) {
			$result['data']['message'] = "Missing required parameter: 'checkout-payment'";
			$this->end_with($result);
		}
        
		$checkout_shipment = $_POST["checkout-shipment"];
        $checkout_payment = $_POST["checkout-payment"];
		$checkout_comment = $_POST["checkout-comment"];
		// if($checkout_comment == null){
		// 	$result['data']['message'] = "Missing required parameter: 'checkout-comment'";
		// 	$this->end_with($result);
		// }
		try {
			@session_start();
			$userId = "43c1b7af-f3e5-11ee-86f0-819f9c311f09";
			$basketResult = null;
			if (isset($_SESSION['user'])) {
				$userId = $_SESSION['user']['id'];
				$data = new DbData();

				$basketResult = $data->getFromBasket($_SESSION['user']['id']);
				if($basketResult != null){
				$data->deleteAllFromBasket($_SESSION['user']['id']);
				}
			}
			else{
				$basketResult = $_SESSION['tempBasket'] ;
				unset($_SESSION['tempBasket']);
			}
			if($basketResult == null){
				return;
			}
			$dataArr = [
				$userId,
				$checkout_name,
				$checkout_surname,
				$checkout_email,
				$checkout_phone,
				$checkout_address,
				$checkout_comment,
				$checkout_shipment,
				$checkout_payment,
				
			] ;
		
				$DbOrders = new DbOrders();
				$order_number = $DbOrders->addToOrders($dataArr);

				foreach ($basketResult as $basketItem) {
					$DbOrders->addToOrderItems($basketItem, $order_number);
				}
				
				

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