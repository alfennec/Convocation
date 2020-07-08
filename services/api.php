<?php

	include_once ('../includes/config.php');
 	$connect->set_charset('utf8');

	$setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
	$setting_result = mysqli_query($connect, $setting_qry);
	$settings_row   = mysqli_fetch_assoc($setting_result);
	$api_key    = $settings_row['api_key']; 	
	
	if (isset($_GET['get_recent_radio'])) {

		if (isset($_GET['api_key'])) {

			$access_key_received = $_GET['api_key'];

			if ($access_key_received == $api_key) {

				$obj = array();
				$query = "SELECT n.id AS 'radio_id', n.radio_name, n.radio_image, n.radio_url, c.category_name FROM tbl_category c, tbl_radio n WHERE c.cid = n.category_id ORDER BY n.id DESC";
				$resouter = mysqli_query($connect, $query);
				while($data = mysqli_fetch_assoc($resouter)) {
					$row['radio_id'] = $data['radio_id'];
					$row['radio_name'] = $data['radio_name'];
					$row['radio_image'] = $data['radio_image'];
					$row['radio_url'] = $data['radio_url'];
					$row['category_name'] = $data['category_name'];
					array_push($obj, $row);
				}

				$set['YourRadioApp'] = $obj;
				
				header( 'Content-Type: application/json; charset=utf-8' );
			    echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
				die();

			} else {
				$respon = array( 'status' => 'failed', 'message' => 'Oops, API Key is Incorrect!');
				header( 'Content-Type: application/json; charset=utf-8' );
			    echo $val = str_replace('\\/', '/', json_encode($respon, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		} else {
			$respon = array( 'status' => 'failed', 'message' => 'Forbidden, API Key is Required!');
			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val = str_replace('\\/', '/', json_encode($respon, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		}	
			
	} else if (isset($_GET['get_category_index'])) {

		if (isset($_GET['api_key'])) {

			$access_key_received = $_GET['api_key'];

			if ($access_key_received == $api_key) {

				$query = "SELECT DISTINCT c.cid, c.category_name, c.category_image, COUNT(DISTINCT r.id) as radio_count FROM tbl_category c LEFT JOIN tbl_radio r ON c.cid = r.category_id GROUP BY c.cid ORDER BY c.cid DESC";
				$resouter = mysqli_query($connect, $query);

				$set = array();
			    $total_records = mysqli_num_rows($resouter);
			    if($total_records >= 1) {
			      	while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
			        $set[] = $link;
			      }
			    }

			    header('Content-Type: application/json; charset=utf-8');
			    echo $val = str_replace('\\/', '/', json_encode($set));

			} else {
				$respon = array( 'status' => 'failed', 'message' => 'Oops, API Key is Incorrect!');
				header( 'Content-Type: application/json; charset=utf-8' );
			    echo $val = str_replace('\\/', '/', json_encode($respon, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		} else {
			$respon = array( 'status' => 'failed', 'message' => 'Forbidden, API Key is Required!');
			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val = str_replace('\\/', '/', json_encode($respon, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		}
			
	} else if (isset($_GET['category_id'])) {

		$query = "SELECT DISTINCT n.id AS 'radio_id', n.radio_name, n.radio_image, n.radio_url, n.category_id, c.category_name FROM tbl_radio n LEFT JOIN tbl_category c ON n.category_id = c.cid WHERE c.cid = '".$_GET['category_id']."' GROUP BY n.id ORDER BY n.id DESC";			
		$resouter = mysqli_query($connect, $query);

		$set = array();
	    $total_records = mysqli_num_rows($resouter);
	    if($total_records >= 1) {
	      	while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
	        $set[] = $link;
	      }
	    }

	    header('Content-Type: application/json; charset=utf-8');
	    echo $val = str_replace('\\/', '/', json_encode($set));		
			
	} else if (isset($_GET['search'])) {

		if (isset($_GET['api_key'])) {

			$access_key_received = $_GET['api_key'];

			if ($access_key_received == $api_key) {
		
				$search = $_GET['search'];
				$obj = array();

				$query = "SELECT DISTINCT n.id AS 'radio_id', n.radio_name, n.radio_image, n.radio_url, c.category_name FROM tbl_radio n LEFT JOIN tbl_category c ON n.category_id = c.cid WHERE n.category_id = c.cid AND (n.radio_name LIKE '%$search%' OR c.category_name LIKE '%$search%') GROUP BY n.id ORDER BY n.id DESC";	

				$resouter = mysqli_query($connect, $query);
				while($data = mysqli_fetch_assoc($resouter)) {

					$row['radio_id'] = $data['radio_id'];
					$row['radio_name'] = $data['radio_name'];
					$row['radio_image'] = $data['radio_image'];
					$row['radio_url'] = $data['radio_url'];
					$row['category_name'] = $data['category_name'];

					array_push($obj, $row);
				
				}

				$set['YourRadioApp'] = $obj;
				
				header( 'Content-Type: application/json; charset=utf-8' );
			    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
				die();

			} else {
				$respon = array( 'status' => 'failed', 'message' => 'Oops, API Key is Incorrect!');
				header( 'Content-Type: application/json; charset=utf-8' );
			    echo $val = str_replace('\\/', '/', json_encode($respon, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		} else {
			$respon = array( 'status' => 'failed', 'message' => 'Forbidden, API Key is Required!');
			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val = str_replace('\\/', '/', json_encode($respon, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		}	
			
	} else if (isset($_GET['get_privacy_policy'])) {

		$query = "SELECT privacy_policy FROM tbl_settings LIMIT 1";			
		$resouter = mysqli_query($connect, $query);

		$set = array();
	    $total_records = mysqli_num_rows($resouter);
	    if($total_records >= 1) {
	      	while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
	        $set = $link;
	      }
	    }

	    header('Content-Type: application/json; charset=utf-8');
	    echo $val = str_replace('\\/', '/', json_encode($set));		
			
	} else if (isset($_GET['get_package_name'])) {

		$query = "SELECT package_name FROM tbl_settings LIMIT 1";			
		$resouter = mysqli_query($connect, $query);

		$set = array();
	    $total_records = mysqli_num_rows($resouter);
	    if($total_records >= 1) {
	      	while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
	        $set = $link;
	      }
	    }

	    header('Content-Type: application/json; charset=utf-8');
	    echo $val = str_replace('\\/', '/', json_encode($set));		
			
	} else {
		header('Content-Type: application/json; charset=utf-8');
		echo "no method found!";
	}
	
	 
?>