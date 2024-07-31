<?php
include 'database.php';
?>
<link rel="stylesheet" href="css/login.css">
<title>Login</title>
<main>
<div class="container">
    <form action="" method="POST">
        <label>Email</label> <input type="text" name="email" /><br><br>
        <label>Password</label> <input name="password" type="password" /><br><br>
        <input type="radio" name="User" value="Admin" /> <label class="ab">Admin</label>
        <input type="radio" name="User" value="User" checked /> <label class="ab">&nbsp;User</label><br>
        <input class="login-btn" type="submit" name="submit" value="Log In" />  <br><br>
		<label>Dont have account ? </label><a href="register.php"> Register Now</a>
    </form>
    
<?php
	if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	    if ($_POST['User'] == 'User') {
    		$skri = $conn->prepare("SELECT * FROM user WHERE email = :email");
	$criteria = [
    'email' => $_POST['email']
	];
	$skri->execute($criteria);

		    $count = $skri->rowCount();
		    if ($count > 0) {
			    $user = $skri->fetch();
			   if (password_verify($_POST['password'], $user['password'])) {
				    $_SESSION['loggedin'] = $user['username'];
				    $_SESSION['id'] = $user['user_id'];
				    echo '<script>window.location.href="evolve.php"</script>';
				    die();
			    } else {
				    echo '<div class="error">Sorry, this password does not match.';
			    }
		    }
			else {
				echo '<div class="error">Sorry, this account does not exist.';
			}
	    }
	    if ($_POST['User'] == 'Admin') {
		    $skri = $conn->prepare('SELECT * FROM admin WHERE email = :email');
		    $crtria = [
		    	'email' => $_POST['email']
		    ];
		    $skri->execute($crtria);
		    if ($skri->rowCount() > 0) {
			    $users = $skri->fetch(); 

                if ($password === $users['password']) {
				    $_SESSION['loggedin'] = $users['username'];
				    $_SESSION['aid'] = $users['id'];
					$_SESSION['type']='admin';
					echo '<script>window.location.href="adminpanel.php"</script>';
				    die();
			    } else {
				    echo '<div class="error">Sorry, this password does not match.';
			    }
		    }
			else {
				echo '<div class="error">Sorry, this account does not exist.';
			}
	   }
} 
?>

