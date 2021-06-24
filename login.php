<?php include 'inc/header.php'; 
include 'AES.php';
$AES = new AES();
?>
<?php
if(isset($_SESSION['Uid'])){
    header('Location: index.php');
}
if(isset($_POST['go'])){
    $email    = $_POST['email'];
    $password = $_POST['password'];
	$password= $AES->encrypt_decrypt('encrypt', $password);
	$email= $AES->encrypt_decrypt('encrypt', $email);
    if(empty($email) || empty($password)){
        echo 'Sorry, please enter all fields';
    }else{
        $selectAll = "SELECT * FROM `users` WHERE u_email='$email' AND u_pass='$password'";
        $result    = $conn->query($selectAll);
		
        if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                   $_SESSION['Uid'] = $row['u_id'];
                   $_SESSION['Uname'] = $row['u_name'];
				   $_SESSION['Uemail'] = $row['u_email'];
                   $_SESSION['Upass'] = $row['u_pass'];
				 //  $_SESSION['Uemail'] = $AES->encrypt_decrypt('decrypt', $row['u_email']);
					//$_SESSION['Upass'] = $AES->encrypt_decrypt('decrypt', $row['u_pass']);
                   $_SESSION['Ulevel'] = $row['u_level'];
				   if($row['u_level']==1)
						header('Location: admin/index.php');
					else
						header('Location: index.php');
                }
        }
    }
}


?>
    <div class="modal-dialog" style="margin-bottom:0">
        <div class="modal-content">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="go" class="btn btn-sm btn-success" value="Login">
                            </fieldset>
                        </form>
                    </div>
                </div>
    </div>
<?php include 'inc/footer.php'; ?>