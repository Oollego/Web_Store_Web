<?php
include_once "ApiController.php";
include_once "data/DbData.php";

class itemidController extends ApiController
{

    protected function do_get(){
		
        $result = [ 'status' => 0
					
		];
		if (empty($_GET["id"])) {
			http_response_code(400);
			$result['message'] = "Missing required parameter: 'SubGroupUri'";
			$this->end_with($result);
		}
        $itemId = $_GET["id"];
            try {
			$row = (new DbData()) ->getItemById($itemId);
				if($row){
				     $result['data'] = $row;
					 $result['status'] = 1;
				}
				else{
				     http_response_code(400);
				}
				
            } catch (PDOException $ex) {
                http_response_code(500);
                echo "query error: " . $ex->getMessage();
                exit;
            }
       
        $this->end_with($result);

    }
}