<?php 
	require_once 'classes/usuarios.php';
	$u = new Usuario;
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Cadastro</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div id="corpo-form-cad">
		<h1>Cadastrar</h1>
		<form method="POST">
			<input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
			<input type="text" name="telefone" placeholder="Telefone" maxlength="30">
			<input type="email" name="email" placeholder="Usuário" maxlength="40">
			<input type="password" name="senha" placeholder="Senha" maxlength="15">
			<input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
			<input type="submit" value="CADASTRAR">
		</form>
	</div>
	<?php 
	
	//verificar se clicou no botão
	if (isset($_POST['nome'])) {
		$nome = addslashes($_POST['nome']);
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);
		$confirmarSenha = addslashes($_POST['confSenha']);
		
		//verificar se esta tudo preenchido
		if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {

			$u->conectar("tela_login","localhost","root","");
			if ($u->msgErro == "") {//se ela esta vazia esta tudo ok

				if ($senha == $confirmarSenha) {

					if ($u->cadastrar($nome,$telefone,$email,$senha)) {
						?>
							<div id="msg-sucesso">
								Cadastrado com sucesso! Acesse para entrar!
							</div>
						<?php
					} else {
						?>
							<div id="msg-sucesso">
								Email já cadastrado!
							</div>
						<?php
					}					
				} else {
					?>
						<div class="msg-erro">
							Senha e confirmar senha não correspondem!
						</div>
					<?php
				}	

			} else {
				?>
					<div class="msg-erro">
						<?php echo "Erro".$u->msgErro; ?>
					</div>
				<?php
			}

		} else {
			?>
				<div class="msg-erro">
					Preencha todos os campos!
				</div>
			<?php
		}
	}

	 ?>
</body>
</html>