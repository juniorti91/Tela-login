<?php 

	Class Usuario {

		private $pdo;
		public $msgErro = "";

		public function conectar($nome, $host, $usuario, $senha) {
			global $pdo;
			try {
				$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);	
			} catch (PDOException $e) {
				$msgErro = $e->getMessage();
			}			
		}

		public function cadastrar($nome, $telefone, $email, $senha) {
			global $pdo;
			//verificar se ja existe um email cadastrado
			$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
			$sql->bindValue(":e", $email);
			$sql->execute();			
			if ($sql->rowCount() > 0) {
				return false; //ja esta cadastrado
			} else { 
				//caso não, Cadastrar no banco
				$sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
				$sql->bindValue(":n", $nome);
				$sql->bindValue(":t", $telefone);
				$sql->bindValue(":e", $email);
				$sql->bindValue(":s", $senha);
				$sql->execute();
				return true;
			}			
		}

		public function logar($email, $senha) {
			global $pdo;
			//verificar se o email e senha estao cadastrados no banco
			$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", $senha);
			$sql->execute();
			if ($sql->rowCount() > 0) {
				//entrar no sistema(sessao)
				$dado = $sql->fetch(); //pega tudo que veio do banco de dados e transforma em array
				session_start();
				$_SESSION['id_usuario'] = $dado['id_usuario']; //agora o ID do usuario que acabou de logar esta amarzenado em um sessão
				return true; //cadastrado com sucesso
			} else {
				return false; //não foi possivel logar
			}
			
		}
	}

 ?>