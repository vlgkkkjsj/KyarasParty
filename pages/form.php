<?php

if(isset($_POST['submit']))
{
    include_once('../DB/DB.php');
    include_once('../DB/MusicFunctions.php');

    $suggest = new MusicDB();

    $musicName = filter_var(trim($_POST['$musicName']),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $author = filter_var(trim($_POST['$author']),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $linkMusic = filter_var(trim($_POST['$linkMusic']),FILTER_SANITIZE_URL);
    $findMusic = filter_var(trim($_POST['$findMusic']),FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $singleSong = $suggest -> singleSong($musicName);

    if(!empty($singleSong['$musicName']))
    {
        header('location: form.php');
    }
    else
    {
        $insert = $suggest -> InsertSong($musicName,$author,$linkMusic,$findMusic);
        if($insert ==  true)
        {
            header('location: form.php?sucess');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
    <title>Sugestão - KYKY's Party</title>
</head>
<body>
    
<?php

if(isset($_GET['exist'])) 
{
    print  "<script>  alert('cpf e/ou email ja existentes')</script>";

}
 if (isset($_GET['sucess']))
{
    print "<script> alert('Formulario enviado com sucesso')</script>";
    header('location: cad-concluido.php');
}
?>  

<div class="tot">
    <form class="tot-form" action="" method="post">
        <div class="tot-form-est">
            <div class="tot-form-est-top">
                <div class="tot-form-est-top-img">
                <img src="../images/logo.png" alt="logo" >
                </div>
                <h2 class="tot-form-est-top-h2">Formulário de Cadastro</h2>
            </div>
            <div>
                <label class="label" for="musicName">Nome da musica:</label>
                <input type="text" id="musicName" name="musicName" required>

                <label class="label" for="author">Autor da musica:</label>
                <input type="text" id="author" name="author" required>

                <label class="label" for="linkMusic">Link da musica (não obrigatorio):</label>
                <input type="text" id="linkMusic" name="linkMusic" required>

                <label class="label" for="findMusic">Plataformas para encontrar (ex: Spotify,YT,Deezer,etc):</label>
                <input type="text" id="findMusic" name="findMusic">
            </div>
            <button class="botão" type="submit" name="submit" >Concluir</button>
        </div>
    </form>
</div>

</body>
</html>