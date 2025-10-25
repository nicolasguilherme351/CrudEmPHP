<?php
require "CRUDemPHP.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>  
    <p>Aqui iremos criar uma atualizar os atributos de um registro da tabela cadastro:</p>
    <form action="Update.php" method="POST">
        Digite o rm do registro que deseja mudar os atributos: <br> <input type="text" name="rm"><br>
        Digite o nome que será mudado do registro que tem o rm que foi colocado acima: <br>      <input type="text" name="nome"><br> 
        Digite o Sobrenome que será mudado do registro que tem o rm que foi colocado acima: <br> <input type="text" name="sobrenome"><br> 
        Digite o Sexo que será mudado do registro que tem o rm que foi colocado acima: <br> <input type="text" name="sexo"><br> 
        Digite o Ano da matricula que será mudado do registro que tem o rm que foi colocado acima: <br> <input type="text" name="ano-matricula"><br> 
        Digite o Curso que será mudado do registro que tem o rm que foi colocado acima: <br> <input type="text" name="curso"><br> <br>
    <input type="submit"> <br>
</form>
</body>
</html>

<?php
require "conn.php";
/*
$stmt = $conn->prepare("SEL");
$stmt->execute();
bind_param("sss", $firstname, $lastname, $email);
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $rm = $_POST["rm"];
  $nome = $_POST["nome"];
  $sobrenome = $_POST["sobrenome"];
  $sexo = $_POST["sexo"];
  $anomatricula = $_POST["ano-matricula"];
  $curso = $_POST["curso"];

if ($rm == null || $nome == null || $sobrenome == null || $sexo == null || $anomatricula == null || $curso == null || $curso == null) {
  throw new Exception("Digite todos os campos.");
} else {
  
  $query = "SELECT * FROM cadastro WHERE rm =" . $rm;
  $execute = mysqli_query($conn, $query);
  $result = mysqli_fetch_assoc($execute);

 
 if ($result["RM"] == null) {
    throw new Exception("Não existe um registro com este rm. ");
  } else {

    $stmt = $conn->prepare("UPDATE cadastro SET NomeALuno = (?), SobenomeAluno = (?),  Sexo = (?), AnoMatricula = (?), Curso = (?) WHERE rm = (?)");
    $stmt->bind_param("sssssi",$nome, $sobrenome, $sexo, $anomatricula, $curso, $rm);
    $stmt->execute();
    
    echo "O aluno foi atualizado";
    
  }

}

}


?>