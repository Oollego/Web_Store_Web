<?php
include_once "data/DbData.php";

class DbOrders extends DbData
{

    function __construct() {
        parent::__construct();
    }

    public function addToOrders($orderdata){
		$sql = "INSERT INTO orders(`user_id`,`buyer_name`, `buyer_surname`, `email`, `phone`, `address`, `comment`, `shipment_method`, `payment_method`)
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?); ";
       	try {
            
			$prep = $this->db->prepare($sql);
            $prep->execute($orderdata);
            $lastId = $this->db->lastInsertId();

            return $lastId;
            // try{
            //     $this->db->beginTransaction();
            //     $prep->execute($orderdata);
            //     $this->db->commit();
            //     $orderId = $this->db->lastInsertId();
            //     return $orderId;

            // }catch(PDOException $ex){
            //     $this->db->rollBack();
            // }
          
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}

	}
    public function addToOrderItems($item, $order_number ){
        $sql = "INSERT INTO orderitems(`item_id`, `quantity`, `status_id`, `order_number_id`, `price`, `sale_price`) 
        VALUES(?,?,?,?,?,?);";
        $orderItemdata = [
            $item["id"],
            $item["quantity"],
            "1",
            $order_number,
            $item["price"],
            $item["sale_rice"]
        ];
        	try {
            
                $prep = $this->db->prepare($sql);
                
                $prep->execute($orderItemdata);

            } catch (PDOException $ex) {
                http_response_code(500);
                echo "query error: " . $ex->getMessage();
                exit;
            }
    }
}