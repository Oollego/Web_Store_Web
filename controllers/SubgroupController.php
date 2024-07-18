<?php

include_once "ApiController.php";
include_once "data/DbData.php";

class SubgroupController extends ApiController
{

    protected function do_get(){
		
        $result = [ 'status' => 0
					
		];
		if (empty($_GET["maingroup"])) {
			$result['message'] = "Missing required parameter: 'MainGroupUri'";
			$this->end_with($result);
		}
        $mainGroup = $_GET["maingroup"];
            try {
				
				$result['data'] = (new DbData()) ->getListOfsubGroup($mainGroup);
                $result['status'] = 1;
				
            } catch (PDOException $ex) {
                http_response_code(500);
                echo "query error: " . $ex->getMessage();
                exit;
            }
       
        $this->end_with($result);

    }
}