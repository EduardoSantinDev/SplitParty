<?php

include 'action.php';

if (isset($_SESSION['user_id'])) {
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
    <title>Tags</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                <li><a class="menu-links active" href="./tags.php">Tags</a></li>
                <li><a class="menu-links" href="./participantes.php">Participantes</a></li>
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
                <input type="text" class="new-text-input" placeholder="Nome da Tag" name="name_tag" value="<?php if (isset($_POST["addTag"])) {echo $_POST['name_tag'];} ?>" required>
                <button type="submit" name="addTag" class="button1">Adicionar Tag</button>
            </form>
        </div>
        <div class="main-content">
            <div class="show-rows">
                <?php 
                    $sql1 = "SELECT * FROM tags WHERE user_id='{$_SESSION['user_id']}' ORDER BY id DESC";
                    $res1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($res1) > 0) {
                        foreach ($res1 as $tag) {
                    ?>
                        <div class="row-content">
                                <input type="text" class="text-input" class="text" value="<?= $tag['name']?>" readonly>
                                <a href="action.php?deleteTag=<?=$tag['id']?>" class="button2">
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
</body>

</html>