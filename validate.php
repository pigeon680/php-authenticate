<?php

include_once ('connection.php');

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	// $cpassword = test_input($_POST['cpassword']);

	$stmt = $conn->prepare('SELECT * FROM adminlogin');
	$stmt->execute();
	$users = $stmt->fetchAll();

	foreach ($users as $user) {
		if (($user['username'] == $username) &&
				($user['password'] == $password)) {
			header('location: PDF Download/htmllinkpdf.php');
		} else {
			// echo "<script language='javascript'>";
			// echo "alert('WRONG INFORMATION')";
			// echo '</script>';
			echo " <div class=\"alert alert-danger  
            \t\talert-dismissible fade show\" role=\"alert\">  
					<strong>Error!</strong>
			
					<button type=\"button\" class=\"close\" action=\"index.php\"
						data-dismiss=\"alert aria-label=\"Close\"> 
					<span aria-hidden=\"true\">×</span>  
					</button>  
			</div> ";
			die();
		}
	}
}

?>