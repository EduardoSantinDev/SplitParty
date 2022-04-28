<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	include 'config.php';

    function getParticipante($participante) {
        $participanteID = $participante['id'];
        $output = '<div class="row-content">
                            <input type="text" class="text-input" class="text" value="'.$participante['name'].'" readonly>
                            <a href="action.php?deleteParticipante=' . $participanteID . '" class="button2">
                                <img alt="delete button" class="show_row_buttons" src="./images/delete.png">
                            </a>
                    </div>';

        echo $output;
    }

    function countProdutos($conn) {
        $sql = "SELECT tag_id, SUM(price) / (SELECT tag_id, COUNT(*) FROM jnct_participantes_tags GROUP BY tag_id) FROM produtos GROUP BY tag_id WHERE user_id='{$_SESSION['user_id']}'";
        $res = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($res)) {
            echo ($row);
        }

        if ($res) {
            $_POST["name_tag"] = "";
        }
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
        $sql1 = "SELECT * FROM tags WHERE user_id='{$_SESSION['user_id']}' ORDER BY id ASC LIMIT 1";
        $res1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($res1) > 0) {
            foreach ($res1 as $tag) {
                $tagID = $tag['id'];
            }
        }
        $sql = "INSERT INTO produtos (name, price, user_id, tag_id) VALUES ('$nameProduto', $priceProduto, $user_id, $tagID)";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $_POST["nameProduto"] = "";
        }
    }

    if (isset($_POST["setProdutoTag"], )) {
        $tagID = $_POST['tagID'];
        $produtoID = $_POST['produtoID'];
        $sql = "UPDATE produtos SET tag_id='{$tagID}' WHERE id='{$produtoID}'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $_POST["tagID"] = "";
            $_POST["produtoID"] = "";
        }
    }

    if (isset($_POST["setParticipantePaid"], )) {
        $participanteID = $_POST['participanteID'];
        
        if (isset($_POST['participantePaid'])) {
            $participantePaid = 1;
        } else {
            $participantePaid = 0;
        }

        $sql = "UPDATE participantes SET paid='{$participantePaid}' WHERE id='{$participanteID}'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $_POST["participantePaid"] = "";
            $_POST["particiapnteID"] = "";
        }
    }

    if (isset($_POST["setParticipanteTag"], )) {
        $participanteID = $_POST['participanteID'];
        $query="DELETE FROM jnct_participantes_tags WHERE participante_id='$participanteID'";
		$stmt=$conn->prepare($query);
		$stmt->execute();
        foreach($_POST['tagIDS'] as $tagID) {
            $sql = "INSERT INTO jnct_participantes_tags (participante_id, tag_id) VALUES ('$participanteID', $tagID)";
            $res = mysqli_query($conn, $sql);
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