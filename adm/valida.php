<?php
	session_start();
	include_once("../conexao/conexao.php");
	//Verifica se os campos possuem dados 
	if((isset($_POST['txt_usuario'])) && (isset($_POST['txt_senha']))){
		$usuario = mysqli_real_escape_string($con, $_POST['txt_usuario']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
		$senha = mysqli_real_escape_string($con, $_POST['txt_senha']);
		$senha = md5($senha);
		
		$result_usuario = "SELECT * FROM tblusuarios WHERE email = '$usuario' && senha = '$senha'";
		$resultado_usuario = mysqli_query($con, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);
		
		//Encontrando um usuário na tabela usuario com os mesmos dados digitado pelo usuario
		if(isset($resultado)){
			$_SESSION['usuarioId']      = $resultado['id'];
			$_SESSION['usuarioNome']    = $resultado['nome'];
			$_SESSION['idnivelacesso']  = $resultado['idnivelacesso'];
			$_SESSION['usuarioEmail']   = $resultado['email'];
			
            
            if($_SESSION['idnivelacesso'] == "1"){
				header("Location: administrativo.php");
			}elseif($_SESSION['idnivelacesso'] == "2"){
				header("Location: colaborador.php");
			}elseif($_SESSION['idnivelacesso'] == "3"){
				header("Location: fornecedor.php");
			}else{
				$_SESSION['loginErro'] = "Erro - Entre em contato juan@gmail.com";
				header("Location: login.php");
			}
		}else{
			$_SESSION['loginErro'] = "Usuário ou senha inválido";
			header("Location: login.php");
		}
	}else{
		$_SESSION['loginErro'] = "Usuário ou senha inválido";
		header("Location: login.php");
	}
?>