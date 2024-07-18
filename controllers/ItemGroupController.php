<?php

include_once "ApiController.php";
include_once "data/DbData.php";

class ItemGroupController extends ApiController
{

	protected function do_get()
	{
		global $page_body;
		$result = [  // REST - як "шаблон" однаковості відповідей АПІ
			'status' => 0,
			'meta' => [
				'api' => 'itemgroup',
				'service' => 'getgroupItems',
				'time' => time()
			],
			'data' => [
				'message' => $_GET
			],
		];
		if (empty($_GET["group_name"])) {
			$result['data']['message'] = "Missing required parameter: 'itemGroupName'";
			$this->end_with($result);
		}
        $group_name = $_GET["group_name"];


		try {
            @session_start();
            $_SESSION['group_name'] = (new DbData()) ->getItemGroupsItemList($group_name);
			$result['status'] = 1;
			
          
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
       
        $this->end_with($result);
	}
}