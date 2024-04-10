<?php
    session_start();
   
    if((!isset ($_SESSION['userAdmin'])==true) and (!isset($_SESSION['password'])==true))
    {
        unset( $_SESSION['userAdmin'] );
        unset( $_SESSION['password']);
        header('Location: ../pages/admin.php');
    }

    $logged = $_SESSION['userAdmin'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png" type="image/png">
    <title>KYKY's Party Administrativo</title>
    <!--<link rel="stylesheet" href="../style/system.css">  alteracaoes necessarias -->
</head>
<body>
<header class="cabecalho">
       <!-- <img class="logo" alt="logo do projeto" src="../img/icon.png"> -->
        <nav class="navegacao">

            <a class="cabecalho-menu"href="?page=listarMusicas">Listar Musicas</a>

        </nav>
         <!-- <button class="sair"  onclick="window.location.href='../sistema/logout.php'" >sair</button>  necessaria alteracao-->
    </header>

    <div class="container">
        <div class="titulo-principal">
         <?php
            include("../DB/DB.php");
            switch(@$_REQUEST["page"]){
                case "home":
                    print "<script>alert('Bem vindo ao sistema administrativo')</script>";
                    print("Bem vindos! Essa é nossa área somente para administradores, aproveite sua estadia e siga o que seus supervisores manderem");
                break;

                case "listarMusicas":
                    include("listSongs.php");
                break;
                
            }
            ?>
        </div>
</div>

</body>
</html>