<?php 

    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "login_register";

    $conn = mysqli_connect($server, $user, $pass, $database) or die ("Erro de conexão com o banco de dados!");

    if (!$conn) {
        die("<script>alert('Connection Failed.')</script>");
    }

    if (isset($_GET['delete'])){
        $id = $_GET['delete'];
        $sql = "DELETE FROM tags WHERE id='$id'";
    }

?>