<?php 

include 'action.php';

if (isset($_SESSION['username'])) {
    
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css" integrity="sha512-g2SduJKxa4Lbn3GW+Q7rNz+pKP9AWMR++Ta8fgwsZRCUsawjPvF/BxSMkGS61VsR9yinGoEgrHPGPn2mrj8+4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header">
        <a id="logo" href="./index.php">
            <img alt="SplitParty" id="logo" src="./images/logo.png">
        </a>
        <nav id="nav">
            <button id="btn-mobile">
            <span id="hamburger"></span>
          </button>
          <ul id="menu" role="menu">
                <li><a class="menu-links" href="./tags.php">Tags</a></li>
                <li><a class="menu-links active" href="./participantes.php">Participantes</a></li>
                <li><a class="menu-links"href="./produtos.php">Produtos</a></li>
                <li><a class="menu-links"href="./resultado.php">Resultado</a></li>
                <li><a class="menu-links"href="./sobre.php">Sobre</a></li>
                <li><a class="menu-links"href="./logout.php"><?php echo $_SESSION['username']; ?> - Sair</a></li>
            </ul>
        </nav>
    </header> 
    <section>
        <div id="add-button-row">
            <form id="new-input-form" action="" method="POST">
                <input type="text" class="new-text-input" placeholder="Nome do Participante" name="nameParticipante" value="<?php if (isset($_POST["addParticipante"])) {echo $_POST['nameParticipante'];} ?>" required>
                <button type="submit" name="addParticipante" class="button1">Adicionar Participante</button>
            </form>
        </div>
        <div class="main-content">
            <div class="show-rows">
                <?php 
                    $sql1 = "SELECT * FROM participantes WHERE user_id='{$_SESSION['user_id']}' ORDER BY id DESC";
                    $res1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($res1) > 0) {
                        foreach ($res1 as $participante) {
                    ?>
                    <div class="row-content">
                            <input type="text" class="text-input" class="text" value="<?=$participante['name']?>" readonly>
                            <form class="tag-submit-participante" action="" method="POST">
                                <select name="tagIDS[]" required placeholder="Tags" class="tag-selector-participante" multiple value="<?php if (isset($_POST["setParticipanteTag"])) {echo $_POST['tagIDS'];} ?>">
                                        <?php 
                                            $sql1 = "SELECT * FROM tags WHERE user_id='{$_SESSION['user_id']}' ORDER BY id DESC";
                                            $res1 = mysqli_query($conn, $sql1);

                                            $sql2 = "SELECT * FROM jnct_participantes_tags WHERE participante_id=10";
                                            $res2 = mysqli_query($conn, $sql2);

                                            while($row = mysqli_fetch_assoc($res2)) {
                                                $tagID_participante[] = $row['tag_id'];
                                            }
                                            if (mysqli_num_rows($res1) > 0) {
                                                foreach ($res1 as $tag) {
                                                    ?>
                                                        <option value="<?=$tag['id']?>"> <?=$tag['name']?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                <input type="hidden" name="participanteID" value="<?=$participante['id']?>">
                                <button type="submit" name="setParticipanteTag" class="button4">✓</button>
                                </form>
                            <a href="action.php?deleteParticipante=<?=$participante['id']?>" class="button2">
                                <img alt="delete button" class="show_row_buttons" src="./images/delete.png">
                            </a>
                    </div>
                    <?php } }
                ?>
            </div>
        </div>

    </section>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/mobile-menu.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js" integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/script.js"></script>
</body>

</html>