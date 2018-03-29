<div class="container">
	<h1>Meus anúncios - Adicionar anúncio</h1>

	<a href="<?php echo BASE_URL; ?>anuncios" class="btn btn-default">Meus anúncios</a><br><br>

	<?php if($cadastrado == 1):?>
	<div class="alert alert-success">Anúncio cadastrado com sucesso!</div>
	<?php endif;?>

	<form method="POST" enctype="multipart/form-data">
		
		<div class="form-group">
			<label for="categoria">Categoria:</label>
			<select name="categoria" id="categoria" class="form-control" required>
				<option>-</option>
				<?php 
					foreach($categorias as $categoria){
						?>
							<option value="<?php echo $categoria['id']?>"><?php echo utf8_encode($categoria['nome'])?></option>
						<?php
					}
				 ?>
			</select>
		</div>
		<div class="form-group">
			<label for="titulo">Titulo:</label>
			<input type="text" name="titulo" id="titulo" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="valor">Valor:</label>
			<input type="text" onkeyup="$(this).mask('000.000.000.000.000,00', {reverse: true});" name="valor" id="valor" class="form-control" placeholder="R$" required>
		</div>
		<div class="form-group">
			<label for="descricao">Descrição:</label>
			<textarea maxlength="200" name="descricao" id="descricao" class="form-control" required></textarea>
		</div>
		<div class="form-group">
			<label for="estado">Estado de conservação:</label>
			<select name="estado" id="estado" class="form-control" required>
				<option>-</option>
				<option value="0">Ruim</option>
				<option value="1">Bom</option>
				<option value="2">Ótimo</option>
			</select>
		</div>
		<button class="btn btn-success">Adicionar</button>

	</form>

</div>