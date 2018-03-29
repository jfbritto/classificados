	<div class="container">
		<h1>Cadastre-se</h1>

		<?php if($alerta == 1): ?>
		<div class="alert alert-success">Cadastrado com sucesso! <b><a href="<?php echo BASE_URL; ?>login">Faça login agora</a></b></div>
		<?php elseif($alerta == 2): ?>
		<div class="alert alert-danger">Email já cadastrado!  <b><a href="<?php echo BASE_URL; ?>login">Faça login agora</a></b></div>
		<?php elseif($alerta == 3): ?>
		<div class="alert alert-warning">Preencha todos os campos</div>
		<?php endif; ?>

		<form method="POST">
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" name="nome" id="nome" class="form-control" autofocus>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control">
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" name="senha" id="senha" class="form-control">
			</div>
			<div class="form-group">
				<label for="telefone">Telefone</label>
				<input type="tel" onkeyup="$(this).mask('(00) 00000-0000');" name="telefone" id="telefone" class="form-control">
			</div>
			<button class="btn btn-default">Cadastrar</button>
		</form>

	</div>
