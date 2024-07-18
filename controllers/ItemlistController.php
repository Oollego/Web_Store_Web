<?php
include_once "ApiController.php";
include_once "data/DbData.php";

class ItemlistController extends ApiController
{

    protected function do_get(){
		
        $result = [ 'status' => 0
					
		];
		if (empty($_GET["subgroup"])) {
			http_response_code(400);
			$result['message'] = "Missing required parameter: 'SubGroupUri'";
			$this->end_with($result);
		}
        $subGroup = $_GET["subgroup"];
            try {
				
		$result['data'] = (new DbData()) ->getSubGroupsItemList($subGroup);
                $result['status'] = 1;
				
            } catch (PDOException $ex) {
                http_response_code(500);
                echo "query error: " . $ex->getMessage();
                exit;
            }
       
        $this->end_with($result);

    }
}