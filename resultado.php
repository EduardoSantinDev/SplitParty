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
    <title>Resultado</title>
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
                <li><a class="menu-links" href="./tags.php">Tags</a></li>
                <li><a class="menu-links" href="./participantes.php">Participantes</a></li>
                <li><a class="menu-links"href="./produtos.php">Produtos</a></li>
                <li><a class="menu-links active"href="./resultado.php">Resultado</a></li>
                <li><a class="menu-links"href="./sobre.php">Sobre</a></li>
                <li><a class="menu-links"href="./logout.php"><?php echo $_SESSION['username']; ?> - Sair</a></li>
            </ul>
        </nav>
    </header>
    <section>
        
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
                            
                            <form class="tag-submit-pago" action="" method="POST">
                                <?php 
                                    if ($participante['paid'] == 1) {
                                        ?>
                                            <input type = "checkbox" checked onchange="this.form.submit()" class="paid-input" name = "participantePaid" value="1">
                                        <?php
                                    } else {
                                        ?>
                                            <input type = "checkbox" onchange="this.form.submit()" class="paid-input" name = "participantePaid" value="1">
                                        <?php
                                    }
                                ?>
                                <input type="hidden" name="participanteID" value="<?=$participante['id']?>">
                                <input type="hidden" name="setParticipantePaid" value="1">
                            </form>
                            <input type="text" class="price-output" class="text" value="R$ " readonly>
                    </div>
                    <?php } }
                ?>
            </div>
        </div>
        <div id="add-button-row">
            <form id="new-input-form" action="" method="POST">
                <input type="text" class="new-text-input" placeholder="Nome do Participante" name="nameParticipante" value="Valor Total:  R$" required>
                <input type="text" class="new-text-input" placeholder="Nome do Participante" name="nameParticipante" value="Valor Pago:  R$" required>
            </form>
        </div>
    </section>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/mobile-menu.js"></script>
</body>

</html>