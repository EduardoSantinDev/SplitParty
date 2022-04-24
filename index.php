<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['user_id'])) {
    header("Location: tags.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_id'] = $row['id'];
		header("Location: tags.php");
	} else {
		echo "<script>alert('Email ou senha incorretos!')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div id="login-container">
        <div class="card" id="login-card">
            <div class="logo-menu">
                <img src="images/logo.png" id="logo">
            </div>
            <form action="" method="POST" class="login-email">
                <input type="email" class="login-input" placeholder="Email" name="email" value="<?php echo $email; ?>" required>   
                <input type="password" class="login-input" placeholder="Senha" name="password" value="<?php echo $_POST['password']; ?>" required>
                <button name="submit" class="button3">Login</button>
                <p class="login-register-text">Não tem uma conta? <a href="registrar.php">Cadastre-se</a></p>
            </form>
        </div>
        <footer>

        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </div>
</body>

</html>