<?php 

$idproduto = isset($_GET["idproduto"]) ? $_GET["idproduto"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  produto where idproduto= :idproduto";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idproduto",$idproduto);
            $stmt->execute();
            header("Location:listarprodutos.php");
        }


        if($idproduto){
            //estou buscando os dados do produto no BD
            $sql = "SELECT * FROM  produto where idproduto= :idproduto";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idproduto",$idproduto);
            $stmt->execute();
            $idproduto = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($produtos);
        }
        if($_POST){
            if($_POST["idproduto"]){
                $sql = "UPDATE produto SET produto=:produto, preco=:preco, estoqueatual=:estoqueatual, estoquemax=:estoquemax, estoquemin=:estoquemin WHERE idproduto=:idproduto";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":produto",$_POST["produto"]);
                $stmt->bindValue(":preco",$_POST["preco"]);
                $stmt->bindValue(":estoqueatual",$_POST["estoqueatual"]);
                $stmt->bindValue(":estoquemax",$_POST["estoquemax"]);
                $stmt->bindValue(":estoquemin",$_POST["estoquemin"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO produto(produto,preco,estoqueatual,estoquemax,estoquemin) VALUES (:produto, :preco, :estoqueatual, :estoquemax, :estoquemin)";
                $stmt = $con->prepare($sql);
               
                $stmt->bindValue(":produto",$_POST["produto"]);
                $stmt->bindValue(":preco",$_POST["preco"]);
                $stmt->bindValue(":estoqueatual",$_POST["estoqueatual"]);
                $stmt->bindValue(":estoquemax",$_POST["estoquemax"]);
                $stmt->bindValue(":estoquemin",$_POST["estoquemin"]);
                $stmt->execute(); 
            }
            header("Location:listarprodutos.php");
        } 
    } catch(PDOException $e){
         echo "erro".$e->getMessage;
        }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bo"></script>
</head>
<body>
<h1>Cadastro de Produtos</h1>
<form method="POST">
Produto         <input type="text" name="produto"          required value="<?php echo isset($idproduto) ? $idproduto->produto: null ?>"><br>
Preço           <input type="text" name="preco"              required value="<?php echo isset($idproduto) ? $idproduto->preco: null ?>"><br>
Estoque Atual   <input type="text" name="estoqueatual"           required value="<?php echo isset($idproduto) ? $idproduto->estoqueatual: null ?>"><br>
Estoque Max     <input type="text" name="estoquemax"    required value="<?php echo isset($idproduto) ? $idproduto->estoquemax: null ?>"><br>
Estoque Min     <input type="text" name="estoquemin"    required value="<?php echo isset($idproduto) ? $idproduto->estoquemin: null ?>"><br>
                <input type="hidden"     name="idproduto"   value="<?php echo isset($idproduto) ? $idproduto->idproduto : null ?>">
                <input type="submit">
</form>
<a href="listarprodutos.php">volta</a>
</body>
</html>