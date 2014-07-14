<?php

class User {
	public $name;
	
	public function getAllSongs() {
		$form_data = array(
				'first_name' => "Ganesh",
				'last_name' => "Naik",
				'email' => "ganeshrn.2009@gmail.com",
				'address1' => "Main Road",
				'address2' => "Naik Wada",
				'address3' => "Nashirabad",
				'postcode' => "425309",
				'tel' => "02572356396",
				'mobile' => "8149359831",
				'website' => "http://www.coolsoftwaresolution.com",
				'contact_method' => "Phone",
				'subject' => "Hello",
				'message' => "Hi my dear php...",
				'how_you_found_us' => "By Internet",
				'time' => "48948549859"
		);
		
		$arr = [];
		
		$db = new DatabaseFunction();
		
// 		$db->connect();
// 		$arr = $db->getTableData('user_login', '*', "where 1");
// 		$db->disconnect();
		
		$cols = array("1", "2", "3");
		echo "<br>".$db->getTableData('user_login', $cols, "1")."<br>";
		echo "<br>".$db->insertRow("GTTTTT", $form_data)."<br>";
		echo "<br>".$db->updateRow("GTTTTT", $form_data, "`tel`='123456789' AND `time`='0'")."<br>";
		echo "<br>".$db->deleteRow("GTTTTT", "`tel`='123456789' AND `time`='0'")."<br>";
		
		return($arr);
	}
}
?>