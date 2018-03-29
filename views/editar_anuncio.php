<div class="container">
	<h1>Meus anúncios - Editar anúncio</h1>

	<a href="<?php echo BASE_URL; ?>anuncios" class="btn btn-default">Meus anúncios</a><br><br>

	<?php if($editado == 1): ?>
		<div class="alert alert-success">Produto editado com sucesso!</div>
	<?php endif; ?>

	<form method="POST" enctype="multipart/form-data">
		
		<div class="form-group">
			<label for="categoria">Categoria:</label>
			<select name="categoria" id="categoria" class="form-control" required>
				<option>-</option>
				<?php 
					foreach($categorias as $categoria){
						?>
							<option value="<?php echo $categoria['id']?>" <?php echo ($anuncio['id_categoria'] == $categoria['id'])?'selected="selected"':''; ?>><?php echo utf8_encode($categoria['nome'])?></option>
						<?php
					}
				 ?>
			</select>
		</div>
		<div class="form-group">
			<label for="titulo">Titulo:</label>
			<input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $anuncio['titulo']?>" required>
		</div>
		<div class="form-group">
			<label for="valor">Valor:</label>
			<input type="text" onkeyup="$(this).mask('000.000.000.000.000,00', {reverse: true});" name="valor" id="valor" class="form-control" placeholder="R$" value="<?php echo number_format($anuncio['valor'], 2,',','.')?>" required>
		</div>
		<div class="form-group">
			<label for="descricao">Descrição:</label>
			<textarea maxlength="200" name="descricao" id="descricao" class="form-control"  value="<?php echo $anuncio['descricao']?>" required><?php echo $anuncio['descricao']?></textarea>
		</div>
		<div class="form-group">
			<label for="estado">Estado de conservação:</label>
			<select name="estado" id="estado" class="form-control" required>
				<option>-</option>
				<option value="0" <?php echo ($anuncio['estado'] == 0)?'selected="selected"':''; ?>>Ruim</option>
				<option value="1" <?php echo ($anuncio['estado'] == 1)?'selected="selected"':''; ?>>Bom</option>
				<option value="2" <?php echo ($anuncio['estado'] == 2)?'selected="selected"':''; ?>>Ótimo</option>
			</select>
		</div>
		<div class="form-group">
			<label for="add_foto">Fotos do anúncio:</label>
			<input type="file" name="fotos[]" multiple><br>

			<div class="panel panel-default">
				<div class="panel-heading">Fotos do anúncio</div>
				<div class="panel-body">
					<?php foreach($anuncio['fotos'] as $foto){ ?>
						<div class="foto_item">
							<img class="img img-thumbnail" src="<?php echo BASE_URL; ?>assets/img/anuncios/<?php echo $foto['url']; ?>" border="0">
							<a href="<?php echo BASE_URL; ?>anuncios/excluirFoto/<?php echo $foto['id']?>" class="btn btn-default">Excluir imagem</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<button class="btn btn-success">Confirmar edição</button>

	</form>

</div>