<?php

include_once "controllers/ApiController.php";

//include_once "data/BaseData";
class DbData
{

	public $db;

	function __construct()
	{
		$this->db = $this->connect_db_or_exit();
	}

	private function connect_db_or_exit()
	{
		try {
			return new PDO(
			'mysql:host=10.10.10.10;port=3306;dbname=web_store;charset=utf8mb4',
				'login',
				'pass',
				[
					//PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				]
			);
		} catch (PDOException $e) {
			http_response_code(500);
			echo "Connection error: " . $e->getMessage();
			exit;
		}
	}

	private function getDbResult($sql)
	{
		try {
			$res = $this->db->query($sql);

			while ($row = $res->fetch()) {
				$arr[] = $row;
			}
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	
	public function CreateUser($userDataArr)
	{

		$sql = "INSERT INTO users(`email`,`user_name`,`password`,`avatar`) VALUES(?,?,?,?) ";
		$prep = $this->db->prepare($sql);

		$prep->execute($userDataArr);
	}

	public function UserAuthChecker($email, $password)
	{
		$sql = "SELECT * FROM users u WHERE u.email = ? AND u.password = ?";

		$prep = $this->db->prepare($sql);
		$prep->execute([$email, md5($password)]);
		$result = $prep->fetch();
		return  $result;
	}
	// CREATE USER 'store_user'@'localhost' IDENTIFIED BY 'store_pass';
	// GRANT ALL PRIVILEGES ON php_store.* TO 'store_user'@'localhost';
	// FLUSH PRIVILEGES;
	
	private function isUserIdExist($userId)
	{
		$sql = "SELECT users.user_name FROM users WHERE users.id = ? ;";

	try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$userId]);
			if($result = $prep->fetch()){
			    return true;
			}
		
			return false;
		
		} 
		catch (PDOException $ex) 
		{
			http_response_code(501);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function getListOfGroup()
	{

		$sql = "SELECT * FROM maingroups";

		try {
			$res = $this->db->query($sql);

			while ($row = $res->fetch()) {
				$arr[] = $row;
			}
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function getListOfItemGroup($subGroup)
	{
		$sql = "SELECT itemgroups.item_group_name FROM itemgroups, subgroups
		WHERE subgroups.id = itemgroups.subgroup_id AND subgroups.uri_name = '{$subGroup}'";
		$arr = $this->getDbResult($sql);
		return $arr;
	}




	public function getListOfsubGroup($groupName)
	{


		$sql = "SELECT subgroups.id, subgroups.sub_name, subgroups.uri_name, subgroups.img 
		FROM subgroups, maingroups 
		WHERE maingroups.id = subgroups.main_group_id AND maingroups.uri_name = ?";

		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$groupName]);
			//$res = $prep->fetch();

			while ($row = $prep->fetch()) {
				$arr[] = $row;
			}
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function getItemForBasket($ItemId){
		$sqlForItem = "SELECT `items`.*, (SELECT itemimages.file_name FROM itemimages WHERE itemimages.item_id = items.id LIMIT 1) 
		AS image_name  FROM `items` WHERE items.id = ? ;";
		try {
			$prep = $this->db->prepare($sqlForItem);
			$prep->execute([$ItemId]);
			$result = $prep->fetch();
			return $result ;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function deleteAllFromBasket($UserId){
		$sql = "DELETE FROM `basket` WHERE basket.user_id = ? ;";
		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$UserId]);
			
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}

	}

	public function getItemById($ItemId)
	{
		$sqlForItem = "SELECT * FROM `items` WHERE items.id = ? ;";
		$sqlForItemFeedBacks = "SELECT feedbacks.* FROM `feedbacks`, `items` WHERE items.id = feedbacks.item_id AND items.id = ?;";
		$sqlForItemImgs = "SELECT itemimages.file_name FROM `itemimages`, `items` WHERE items.id = itemimages.item_id AND items.id = ?;";
		$sqlForItemFeatures = "SELECT features.feature_name, features.feature_text FROM `features`, `items` WHERE items.id = features.item_id AND items.id = ?;";
		try {
			$prep = $this->db->prepare($sqlForItem);
			$prep->execute([$ItemId]);
			$arr["data"] = $prep->fetch();

			$prep = $this->db->prepare($sqlForItemFeedBacks);
			$prep->execute([$ItemId]);
			while ($row = $prep->fetch()) {
				$arr["feedbacks"][] = $row;
			}

			$prep = $this->db->prepare($sqlForItemImgs);
			$prep->execute([$ItemId]);
			while ($row = $prep->fetch()) {
				$arr["imgs"][] = $row;
			}

			$prep = $this->db->prepare($sqlForItemFeatures);
			$prep->execute([$ItemId]);
			while ($row = $prep->fetch()) {
				$arr["features"][] = $row;
			}

			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function getSubGroupsItemList($uri_name)
	{

		$sql = "SELECT items.*, (SELECT itemimages.file_name FROM itemimages WHERE itemimages.item_id = items.id LIMIT 1) AS image_name,
		(SELECT AVG(score) AS feedback_score FROM feedbacks WHERE items.id = feedbacks.item_id) AS feedback_avg FROM items 
		INNER JOIN itemgroups ON itemgroups.id = items.item_group_id
		INNER JOIN subgroups ON subgroups.id = itemgroups.subgroup_id
		WHERE subgroups.uri_name = ? ;";

		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$uri_name]);
			//$res = $prep->fetch();

			while ($row = $prep->fetch()) {
				$arr[] = $row;
			}
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function getItemGroupsItemList($uri_name)
	{

		$sql = "SELECT items.*, (SELECT itemimages.file_name FROM itemimages WHERE itemimages.item_id = items.id LIMIT 1) AS image_name,
		(SELECT AVG(score) AS feedback_score FROM feedbacks WHERE items.id = feedbacks.item_id) AS feedback_avg FROM items 
		INNER JOIN itemgroups ON itemgroups.id = items.item_group_id WHERE itemgroups.item_group_name = ? ;";
		// SELECT items.*, (SELECT itemimages.fileName FROM itemimages WHERE itemimages.itemId = items.id LIMIT 1) AS imageName,
		// (SELECT AVG(score) AS feedbackScore FROM feedbacks WHERE items.id = feedbacks.itemId) AS feedbackAvg FROM items 
		// INNER JOIN itemgroups ON itemgroups.id = items.itemGroupId WHERE itemgroups.itemGroupName = "Apple";
		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$uri_name]);


			while ($row = $prep->fetch()) {
				$arr[] = $row;
			}
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}
	

	public function addToBasket($userid, $itemid)
	{

		$sql = "INSERT INTO basket(`user_id`,`item_id`) VALUES( ?, ?);";

		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$userid, $itemid]);
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}
	public function basketItemQuantityChanger($basketItemId, $quantity, $addOrSub){
		if($addOrSub === "add"){
			$quantity++;
		}
		else if($addOrSub === "sub"){
			if($quantity <= 1){
				return;
			}
			$quantity--;
		}
		else{ return ; }
		
		$sql = "UPDATE basket SET quantity = ? WHERE basket.id = ?;" ;
		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$quantity, $basketItemId]);
			
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}

	}
// 	SELECT DISTINCT features.featureName, features.featureText FROM features 
// INNER JOIN items ON items.id = features.itemId 
// GROUP by `features`.featureText 
// ORDER BY `features`.`featureName` ASC
// 	SELECT DISTINCT features.featureName, features.featureText FROM features
// INNER JOIN items ON items.id = features.itemId
// GROUP by features.featureName, features.featureText
	// SELECT DISTINCT features.featureName, features.featureText FROM features
	// INNER JOIN items ON items.id = features.itemId
	// WHERE items.itemName LIKE "%apple%";
	
	public function showItemsBySearch($searchKey){
		
		$sql = "SELECT items.*, (SELECT itemimages.file_name FROM itemimages WHERE itemimages.item_id = items.id LIMIT 1) AS image_name,
		(SELECT AVG(score) AS feedback_score FROM feedbacks WHERE items.id = feedbacks.item_id) AS feedback_avg FROM items 
		WHERE items.item_name like ? ;";
		$searchKey = "%".$searchKey."%";
		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$searchKey]);
			//$res = $prep->fetch();

			while ($row = $prep->fetch()) {
				$arr[] = $row;
			}
			// global $itemsTempArr;
			// $itemsTempArr = $arr;
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function getItemsFilters($searchKey){
		$sql="SELECT DISTINCT features.feature_name, features.feature_text FROM features 
		INNER JOIN items ON items.id = features.item_id 
		WHERE `items`.item_name like ?
		GROUP by `features`.feature_text 
		ORDER BY `features`.`feature_name` ASC";
		$searchKey = "%".$searchKey."%";

		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$searchKey]);
			//$res = $prep->fetch();

			while ($row = $prep->fetch()) {
				$arr[] = $row;
			}
			// global $itemsTempArr;
			// $itemsTempArr = $arr;
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function checkItemInBasket($userId, $itemId){
		$sql = "SELECT basket.* FROM basket WHERE user_id = ? AND item_id = ?";
		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$userId, $itemId]);
			$row = $prep->fetch();
			if($row){
				return $row;
			}
			false;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}
	public function getFromBasket($userid)
	{

		$sql = "SELECT items.*, `quantity`, 
		(SELECT itemimages.file_name FROM itemimages 
		WHERE itemimages.item_id = items.id LIMIT 1) 
		AS image_name 
		FROM basket
		INNER JOIN items ON items.id = basket.item_id
		INNER JOIN users ON users.id = basket.user_id
		WHERE users.id = ? ;";

		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$userid]);

			$arr = null;
			while ($row = $prep->fetch()) {
				$arr[] = $row;
			}
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}

	public function deleteItemFromBasket($itemid, $userid){

		$sql = "DELETE FROM basket WHERE basket.item_id = ? AND basket.user_id = ?;";

		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$itemid, $userid]);

		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}

	}

	public function countBasketItems($userid){
		$sql = "SELECT COUNT(*) AS count FROM `basket` WHERE user_id = ? ;";

		try {
			$prep = $this->db->prepare($sql);
			$prep->execute([$userid]);

			$row = $prep->fetch();
			return $row["count"] ;

		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}
}