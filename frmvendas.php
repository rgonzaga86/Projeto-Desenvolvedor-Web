<?php 

$idvenda = isset($_GET["idvenda"]) ? $_GET["idvenda"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM venda where idvenda= :idvenda";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvenda",$idvenda);
            $stmt->execute();
            header("Location:listarvendas.php");
        }


        if($idvenda){
            //estou buscando os dados do produto no BD
            $sql = "SELECT * FROM  venda where idvenda= :idvenda";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvenda",$idvenda);
            $stmt->execute();
            $idvenda = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($venda);
        }
        if($_POST){
            if($_POST["idvenda"]){
                $sql = "UPDATE venda SET dtvenda=:dtvenda, idproduto=:idproduto, idvendedor=:idvendedor, qtdvenda=:qtdvenda WHERE idvenda=:idvenda";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":dtvenda", $_POST["dtvenda"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue("idvendedor", $_POST["idvendedor"]);
                $stmt->bindValue(":qtdvenda", $_POST["qtdvenda"]);
                $stmt->bindValue ("idvenda", $_POST["idvenda"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO venda (dtvenda, idproduto, idvendedor, qtdvenda) VALUES (:dtvenda, :idproduto, :idvendedor, :qtdvenda)";
                $stmt = $con->prepare($sql);
               
                $stmt->bindValue(":dtvenda", $_POST["dtvenda"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue("idvendedor", $_POST["idvendedor"]);
                $stmt->bindValue(":qtdvenda", $_POST["qtdvenda"]);
                $stmt->execute(); 
            }
            header("Location:listarvendas.php");
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
    
    <meta charset="utf-8">

      
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head> 

    <script src="cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

    <script src="cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bo"></script>
</head>
<body>
    <h1>Cadastro de Vendas</h1>
    <div class="container">
        <form method="POST">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <p class="form-label">Data da Venda </p>  
                        <input type="date" class="form-control" name="dtvenda" required value="<?php echo isset($idvenda) ? $idvenda->dtvenda: null  ?>"><br>
                        <p class="form-label">Id Vendedor </p>    
                        <input type="text" class="form-control" name="idvendedor" required value="<?php echo isset($idvenda) ? $idvenda->idvendedor: null ?>"><br>
                        <p class="form-label">Id Produto </p>      
                        <input type="text" class="form-control" name="idproduto" required value="<?php echo isset($idvenda) ? $idvenda->idproduto: null ?>"><br>
                        <p class="form-label">Qtd Venda  </p>    
                        <input type="text" class="form-control" name="qtdvenda" required value="<?php echo isset($idvenda) ? $idvenda->qtdvenda:  null ?>"><br>
                    </div>
                </div>
            </div>
            <input type="hidden"     name="idvenda"   value="<?php echo isset($idvenda) ? $idvenda->idvenda : null ?>">
            <div class="row">
                <div class="col">
                    <a href="listarvendas.php" class="btn btn-primary">Volta</a>
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</body>
</html>