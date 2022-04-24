<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Usuário registrado com sucesso!')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Algo deu errado!')</script>";
			}
		} else {
			echo "<script>alert('Email já cadastrado!')</script>";
		}
		
	} else {
		echo "<script>alert('Senhas não conferem!')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
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
                <input type="text" class="login-input" placeholder="Usuário" name="username" value="<?php echo $username; ?>" required>
                <input type="email" class="login-input" placeholder="Email" name="email" value="<?php echo $email; ?>" required>   
                <input type="password" class="login-input" placeholder="Senha" name="password" value="<?php echo $_POST['password']; ?>" required>
                <input type="password" class="login-input" placeholder="Confirmar senha" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
                <button name="submit" class="button3">Registrar</button>
                <p class="login-register-text">Tem uma conta? <a href="index.php">Conecte-se</a></p>
            </form>
        </div>
        <footer>

        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </div>
</body>

</html>