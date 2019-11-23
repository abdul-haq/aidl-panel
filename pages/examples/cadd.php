<?php
  require_once('../../config/db.php');
  $upload_dir = 'images/';

  if (isset($_POST['Submit'])) {
    $name = $_POST['name'];
   
    $desc = $_POST['desc'];

    $imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

    if(empty($name)){
			$errorMsg = 'Please input client name';
		}elseif(empty($desc)){
			$errorMsg = 'Please input client description';
		}else{

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 5000000){
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}


		if(!isset($errorMsg)){
			$sql = "insert into add_client(cname, cdesc, cimage)
					values('".$name."', '".$desc."', '".$userPic."')";
			$result = mysqli_query($link, $sql);
			if($result){
				$successMsg = 'New record added successfully';
				header('Location: clients.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($link);
			}
		}
  }
?>
