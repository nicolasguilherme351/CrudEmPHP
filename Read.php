
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
    <p>Aqui iremos ler um registro da tabela cadastro: </p>
    <form action="Read.php" method="POST">
        Digite o rm do aluno que você quer ver as informações: <input type="text" name="rm"><br><br>
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
 
if ($rm == null) {
 throw new Exception("Digite o rm. ");
} else {
 
  $query = "SELECT * FROM cadastro WHERE rm =" . $rm;
  $execute = mysqli_query($conn, $query);
  $result = mysqli_fetch_assoc($execute);

  if ($result["RM"] == null) {
    throw new Exception("Não existe um registro com este rm. ");
  } else {

  echo "O nome do aluno é " . $result['NomeAluno'] . ", sobrenome do aluno é " . $result['SobenomeAluno']; 
  echo ", o gênero do aluno é "; 
  echo $result['Sexo'] == 'M' ?  "Masculino," : "Feminino,";
  echo "<br>";
  echo " o ano da matricula é " . $result['AnoMatricula']  . " e o curso é " . $result['Curso'] . ".";

 
  }

 }
 
 }


?>