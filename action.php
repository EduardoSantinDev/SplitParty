<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	include 'config.php';

	$update=false;
	$id="";
	$name="";
	$email="";
	$phone="";
	$photo="";

	function getTag($tag)
    {
        $tagID = $tag['id'];
        $output = '<div class="row-content">
                            <input type="text" class="text-input" class="text" value="'.$tag['name'].'" readonly>
                            <a href="action.php?deleteTag=' . $tagID . '" class="button2">
                                <img alt="delete button" class="show_row_buttons" src="./images/delete.png">
                            </a>
                    </div>';

        echo $output;
    }

    function getParticipante($participante)
    {
        $participanteID = $participante['id'];
        $output = '<div class="row-content">
                            <input type="text" class="text-input" class="text" value="'.$participante['name'].'" readonly>
                            <a href="action.php?deleteParticipante=' . $participanteID . '" class="button2">
                                <img alt="delete button" class="show_row_buttons" src="./images/delete.png">
                            </a>
                    </div>';

        echo $output;
    }

    function getProduto($produto)
    {
        $produtoID = $produto['id'];
        $output = '<div class="row-content">
                            <input type="text" class="text-input" class="text" value="'.$produto['name'].'" readonly>
                            <input type="text" class="text-input" class="text" value="R$ '.$produto['price'].'" readonly>
                            <a href="action.php?deleteProduto=' . $produtoID . '" class="button2">
                                <img alt="delete button" class="show_row_buttons" src="./images/delete.png">
                            </a>
                    </div>';

        echo $output;
    }
    
    if (isset($_POST["addTag"])) {
        $name_tag = mysqli_real_escape_string($conn, $_POST["name_tag"]);
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO tags (name, user_id) VALUES ('$name_tag', $user_id)";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $_POST["name_tag"] = "";
        }
    }

    if (isset($_POST["addParticipante"])) {
        $nameParticipante = mysqli_real_escape_string($conn, $_POST["nameParticipante"]);
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO participantes (name, user_id) VALUES ('$nameParticipante', $user_id)";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $_POST["nameParticipante"] = "";
        }
    }

    if (isset($_POST["addProduto"])) {
        $nameProduto = mysqli_real_escape_string($conn, $_POST["nameProduto"]);
        $priceProduto = (float)$_POST["priceProduto"];
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO produtos (name, price, user_id) VALUES ('$nameProduto', $priceProduto, $user_id)";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $_POST["nameProduto"] = "";
        }
    }

    if(isset($_GET['deleteTag'])){
		$id=$_GET['deleteTag'];
		$query="DELETE FROM tags WHERE id='$id'";
		$stmt=$conn->prepare($query);
		$stmt->execute();
		header('location:tags.php');
	}

    if(isset($_GET['deleteParticipante'])){
		$id=$_GET['deleteParticipante'];
		$query="DELETE FROM participantes WHERE id='$id'";
		$stmt=$conn->prepare($query);
		$stmt->execute();
		header('location:participantes.php');
	}

    if(isset($_GET['deleteProduto'])){
		$id=$_GET['deleteProduto'];
		$query="DELETE FROM produtos WHERE id='$id'";
		$stmt=$conn->prepare($query);
		$stmt->execute();
		header('location:produtos.php');
	}
?>