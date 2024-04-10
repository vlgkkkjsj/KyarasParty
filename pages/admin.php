<?php

if(isset($_POST['submit']))
{
    include('../DB/DB.php');
    include('../DB/MusicFunctions.php');

    $adminlog = new MusicDB();

    $userAdmin = filter_input(INPUT_POST, 'userAdmin' , FILTER_SANITIZE_URL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $adminLogin = $adminlog -> LoginAdmin($userAdmin, $password);

    if($adminLogin == true)
    {
        session_start();
        $_SESSION['$userAdmin'] = $userAdmin;
        header('location: ../admin/system.php');
    }
    else
    {
        header('location: admin.php?error');
    }
}



?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/admin.css">
    <title>Login</title>
    
</head>
<body>

<?php

if(isset($_GET['error']))
{
    print "<script>alert('usuario e/ou password incorretos')</script>";
}
?>

<div class="login-container">
    <div class="login-container-est">
        <div class="login-container-est-int">
            <div class="login-container-est-top">
                <div class="login-container-est-top-img">
                    <img src="../images/logo.png" alt="logo" >
                </div>
                <h2 class="login-container-est-h2">Área restrita</h2>
            </div>
            <form class="tot-form" action="" method="post">
                <div class="login-container-est-int-input">
                    <input id="userAdmin" type="text" name="userAdmin" placeholder="Login" required>
                    <input id="password" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="login-container-est-int-bnt">
                    <button class="botão" type="submit" name="submit" id= "submit" >Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>