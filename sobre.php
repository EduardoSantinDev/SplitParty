<?php 

include 'config.php';

session_start();

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
    <title>Sobre</title>
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
                <li><a class="menu-links"href="./resultado.php">Resultado</a></li>
                <li><a class="menu-links active"href="./sobre.php">Sobre</a></li>
                <li><a class="menu-links"href="./logout.php"><?php echo $_SESSION['username']; ?> - Sair</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <div class="main-content">
            <p><br></p>
            <h3>Sobre nós</h3>
            <nobr><a href="https://www.instagram.com/edu.ardodev/">@eduardo.dev</a>
                (Desempregado)
            </nobr>
            <nobr><a href="https://www.instagram.com/__.kayo.__">@__.kayo.__</a>
                (Agiota)
            </nobr>
            <nobr><a href="https://www.instagram.com/fabiano_isj/">@fabiano_isj</a>
                (Engenheiro de Pipa)
            </nobr>
            <nobr><a href="https://www.instagram.com/santos_dieguh/">@santos_dieguh</a>
                (Técnico do Grêmio)
            </nobr>
            <p><br></p>
            <h3>Sobre o projeto</h3>
            <p>
                O SplitParty é um projeto escolar, idealizado e construído por Eduardo Santiago, Diego Santos, Kayo Rodrigues e Fabiano.<br>O objetivo é facilitar 
                o gerenciamento de festas por meio do cálculo automático de valores a partir de informações de tags, preços e participantes.<br>
                A ideia surgiu quando um dos programadores notou a dificuldade presente em organizar uma festa de fim de ano, com vários membros da família.<br>
                O projeto está em desenvolvimento ativo e passa por mudanças contantes, podendo acarretar em ocasionais quedas ou mudanças de dados.
            </p>
        </div>
    </section>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/mobile-menu.js"></script>
</body>

</html>