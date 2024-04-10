<h1>Lista Musicas</h1>

<?php


include("../DB/MusicFunctions.php");

$musicDB = new MusicDB(); // Cria uma instância da classe UsuarioDB

$res = $musicDB->ListSongs(); // Chama o método ListarUsuarios para obter os usuários

$qtd = count($res); // Obtém a quantidade de usuários

if ($qtd > 0) {
    echo "<table class='table'>";
    echo "<th>ID</th>";
    echo "<th>Nome da musica</th>";
    echo "<th>Autor</th>";
    echo "<th>Link da musica</th>";
    echo "<th>Onde encontrar a musica</th>";
    
    foreach ($res as $row) {
        echo "<tr>";
        echo "<td>" . $row->getID() . "</td>";
        echo "<td>" . $row->getMusicName() . "</td>";
        echo "<td>" . $row->getAuthor() . "</td>";
        echo "<td>" . $row->getLinkMusic() . "</td>";
        echo "<td>" . $row->getFindMusic() . "</td>";
    }
    echo "</table>";
} else {
    echo "<p class='alert alert-danger'>Nenhum cadastro encontrado!!!</p>";
}
?>