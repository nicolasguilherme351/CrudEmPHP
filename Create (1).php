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
    <p>Aqui iremos criar um novo registro na tabela cadastro:</p>
    <form action="Create.php" method="POST">
        RM: <input type="text" name="rm"><br>
        Nome aluno: <input type="text" name="nome"><br>
        Sobrenome aluno: <input type="text" name="sobrenome"><br>
        Sexo: <input type="text" name="sexo"><br>
        Ano matricula: <input type="text" name="ano-matricula"><br>
        Curso: <input type="text" name="curso"><br><br>
    <input type="submit">
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

    $stmt = $conn->prepare("INSERT INTO cadastro VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $rm, $nome, $sobrenome, $sexo, $anomatricula, $curso);
    $stmt->execute();
    echo "O aluno foi inserido. ";

  } else {
    throw new Exception("Não pode existir dois alunos com o mesmo rm. Digite outro rm, com estes mesmos atributos. ");
  }
   


}

}


?>