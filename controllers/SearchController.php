<?php

include_once "ApiController.php";
include_once "data/DbData.php";

class SearchController extends ApiController
{
	
	protected function do_get()
	{
		
		$result = [  // REST - як "шаблон" однаковості відповідей АПІ
			'status' => 0,
			'meta' => [
				'api' => 'item',
				'service' => 'getItems',
				'time' => time()
			],
			'data' => [
				'message' => $_GET
			],
		];
		if (empty($_GET["search_name"])) {
			$result['data']['message'] = "Missing required parameter: 'ItemId'";
			$this->end_with($result);
		}
        $searchName = $_GET["search_name"];
		
		global $itemsTempArr;
		
		try {
			
            $itemsTempArr = (new DbData()) ->showItemsBySearch( $searchName);
			$result['status'] = 1;
			$_SESSION['group_name'] = $itemsTempArr;
			// global $page_body;
			// $page_body = 'items.php';
			// include ('_layout.php') ; 
            
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
       
        $this->end_with($result);
	}
}