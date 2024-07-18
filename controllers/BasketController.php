<?php

include_once "ApiController.php";
include_once "data/DbData.php";

class BasketController extends ApiController
{
     protected function do_get(){
		
		$result = [ 'status' => 0
					
		];
		
         if (empty($_GET["sessionid"])) 
		 {
     		$result['data']['message'] = "Missing required parameter: 'sessionid'";
     		$this->end_with($result);
     	 }

         $userId = $_GET["sessionid"] ;
		 
 		 if(true)
 		 {
			 try{
			 $result['data'] = (new DbData()) -> getFromBasket($userId);
             $result['status'] = 1;
			 http_response_code(200);
			 } catch (PDOException $ex) {
                http_response_code(501);
                echo "query error: " . $ex->getMessage();
                exit;
            }
		 }
		 else{
			 http_response_code(401);
		 }
		
		 $this->end_with($result);
       
    }
    // protected function do_get(){
    //     $result = [  
    // 		'status' => 0,
    // 		'meta' => [
    // 			'api' => 'basket',
    // 			'service' => 'addItemToBasket',
    // 			'time' => time()
    // 		],
    // 		'data' => [
    // 			'message' => $_GET
    // 		],
    // 	];

    //     if (empty($_GET["user_id"])) {
    // 		$result['data']['message'] = "Missing required parameter: 'ItemId'";
    // 		$this->end_with($result);
    // 	}

    //     $userId = $_GET["user_id"] ;

    //     @session_start() ;
    //     if(isset($_SESSION['user'])){
    //         try {
    //             $userId = $_SESSION['user']['id'] ;
    //             (new DbData())->getFromBasket($userId);
    //             $result['status'] = 1;
    //             $result['data']['message'] = "User is not signin";
    //             $res = (new dbData())->UserAuthChecker($email, $password);
    //             if ($res === false) {
    //                 $result['data']['message'] = "Credentials rejected";
    //                 $this->end_with($result);
    //             };
    // 		if ($res === false) {
    // 			$result['data']['message'] = "Credentials rejected";
    // 			$this->end_with($result);
    // 		}
    //         } catch (PDOException $ex) {
    //             http_response_code(500);
    //             echo "query error: " . $ex->getMessage();
    //             exit;
    //         }
    //     }
    //     else{
    //         $_SESSION['tempBasket'] = $itemId;
    //     }

    //     $this->end_with($result);

    // }
    protected function do_post()
    {

        $result = [
            'status' => 0,
            'meta' => [
                'api' => 'basket',
                'service' => 'addItemToBasket',
                'time' => time()
            ],
            'data' => [
                'message' => $_POST
            ],
        ];

        if (empty($_POST["item_id"])) {
            $result['data']['message'] = "Missing required parameter: 'ItemId'";
            $this->end_with($result);
        }

        $itemId = $_POST["item_id"];
        $dbData = new DbData();
        @session_start();
        if (isset($_SESSION['user']) || isset($_POST["user_id"])) {
            try {
                $userId;
				if(empty($_POST["user_id"])){
					$userId = $_SESSION['user']['id'];
				}
				else{
					$userId =$_POST["user_id"];
				}
               
                $itemInBasket = $dbData->checkItemInBasket($userId, $itemId);
                if ($itemInBasket) {
                    $dbData->basketItemQuantityChanger($itemInBasket["id"], $itemInBasket["quantity"], "add");
                } else {

                    $dbData->addToBasket($userId, $itemId);
                }
                $result['status'] = 1;
                $result['data']['message'] = "Item added to basket ";
            } catch (PDOException $ex) {
                http_response_code(501);
                echo "query error: " . $ex->getMessage();
                exit;
            }
        } else {
            $ifIdExist = false;
            if (isset($_SESSION['tempBasket'])) {
                foreach ($_SESSION['tempBasket'] as &$basketItm) {
                    if (in_array($itemId, $basketItm, true)) {
                        $basketItm["quantity"]++;
                        $ifIdExist = true;
                        break;
                    };
                }
            }
            if (!$ifIdExist) {
                $itemSession = $dbData->getItemForBasket($itemId);
                $itemSession["quantity"] =  1;
                $_SESSION['tempBasket'][] = $itemSession;
            }

            $result['status'] = 1;
            $result['data']['message'] = "User is not signin item added to session";
            //unset($_SESSION['tempBasket']);
        }

        $this->end_with($result);
    }

    protected function do_delete()
    {
        $result = [
            'status' => 0,
            'meta' => [
                'api' => 'basket',
                'service' => 'deleteItemFromBasket',
                'time' => time()
            ],
            'data' => [
                'message' => $_GET
            ],
        ];

        if (empty($_GET["item_id"])) {
            $result['data']['message'] = "Missing required parameter: 'ItemId'";
            $this->end_with($result);
        }
        $itemId = $_GET["item_id"];
        $ifIdExist = false;
        @session_start();
        if (isset($_SESSION['user']) || isset($_GET["user_id"])) {
            try {
				$userId;
				if(empty($_GET["user_id"])){
					$userId = $_SESSION['user']['id'];
				}
				else{
					$userId =$_GET["user_id"];
				}
                (new DbData())->deleteItemFromBasket($itemId, $userId);
                $result['status'] = 1;
                $result['data']['message'] = "Item is deleted";
                $ifIdExist = true;
            } catch (PDOException $ex) {
                http_response_code(500);
                echo "query error: " . $ex->getMessage();
                exit;
            }
        } else {
            if (isset($_SESSION['tempBasket'])) {
                for ($i = 0; $i < count($_SESSION['tempBasket']); $i++) {
                    // foreach ($_SESSION['tempBasket'] as &$basketItm ) {
                    if (in_array($itemId, $_SESSION['tempBasket'][$i], true)) {
                        unset($_SESSION['tempBasket'][$i]);
                        $result['status'] = 1;
                        $result['data']['message'] = "Item is deleted from session";
                        $ifIdExist = true;
                        break;
                    };
                }
            }

            if (!$ifIdExist) {
                $result['status'] = 0;
                $result['data']['message'] = "Basket is empty";
            }
        }

        $this->end_with($result);
    }

    protected function do_put()
    {
        $result = [
            'status' => 0,
            'meta' => [
                'api' => 'basket',
                'service' => 'updateQuantityInBasket',
                'time' => time()
            ],
            'data' => [
                'message' => $_GET
            ],
        ];
        $isAddOrSub = $_GET["AddOrSub"];
        if ( (empty($_GET["item_id"])) || (empty($_GET["AddOrSub"])) ) {
            $result['data']['message'] = "Missing required parameter: 'ItemId' or 'isAddOrSub'";
            $this->end_with($result);
        }
        // if (($isAddOrSub != "add") ) {
        //     $result['data']['message'] = "Parameter 'isAddOrSub' is not correct";
        //     $this->end_with($result);
        // }
        // if (($isAddOrSub != "sub")) {
        //     $result['data']['message'] = "Parameter 'isAddOrSub' is not correct";
        //     $this->end_with($result);
        // }

        $itemId = $_GET["item_id"];

        $ifIdExist = false;
        $dbData = new DbData();

        @session_start();
        if (isset($_SESSION['user']) || isset($_GET["user_id"])) {
            try {
				$userId;
				if(empty($_GET["user_id"])){
					$userId = $_SESSION['user']['id'];
				}
				else{
					$userId =$_GET["user_id"];
				}
                $itemInBasket = $dbData->checkItemInBasket($userId, $itemId);
                if (!$itemInBasket) {
                    $result['data']['message'] = "'Itemid' is not correct or basket is empty";
                    $this->end_with($result);
                } else {
                    if ($isAddOrSub == "add") {
                        $dbData->basketItemQuantityChanger($itemInBasket["id"], $itemInBasket["quantity"], "add");
                        $result['status'] = 1;
                        $result['method'] = "add";
                        $result['data']['message'] = "Item quantity is added";
                    } else if ($isAddOrSub == "sub") {
                        if ($itemInBasket["quantity"] > 1) {
                            $dbData->basketItemQuantityChanger($itemInBasket["id"], $itemInBasket["quantity"], "sub");
                            $result['status'] = 1;
                            $result['method'] = "sub";
                            $result['data']['message'] = "Item quantity is subtracted";
                        }
                    }
                }
            } catch (PDOException $ex) {
                http_response_code(500);
                echo "query error: " . $ex->getMessage();
                exit;
            }
        } else {
           
            if (isset($_SESSION['tempBasket'])) {
                foreach ($_SESSION['tempBasket'] as &$basketItm) {
                    if (in_array($itemId, $basketItm, true)) {
                        if ($isAddOrSub == "add") {
                            $basketItm["quantity"]++;
                            break;
                        } else if ($isAddOrSub == "sub") {
                            if ($basketItm["quantity"] > 1) {
                                $basketItm["quantity"]--;
                                break;
                            }
                        }
                    };
                }
            }
            $result['status'] = 1;
            $result['data']['message'] = "User is not signin item added to session";
            //unset($_SESSION['tempBasket']);
        }

        $this->end_with($result);
    }
}
