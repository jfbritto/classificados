<div class="container">
		<h1>Entrar</h1>


		<?php if($incorreto):?>
		<div class="alert alert-danger">Dados incorretos</div>
		<?php endif?>
		<form method="POST">

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control" autofocus>
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" name="senha" id="senha" class="form-control">
			</div>

			<button class="btn btn-default">Entrar</button>
		</form>

</div>