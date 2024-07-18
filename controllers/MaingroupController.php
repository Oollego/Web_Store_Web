<?php

include_once "ApiController.php";
include_once "data/DbData.php";

class MaingroupController extends ApiController
{

    protected function do_get(){
		
        $result = [ 'status' => 0
					
		];

            try {
				
				$result['data'] = (new DbData()) ->getListOfGroup();
                $result['status'] = 1;
				
            } catch (PDOException $ex) {
                http_response_code(500);
                echo "query error: " . $ex->getMessage();
                exit;
            }
       
        $this->end_with($result);

    }
}