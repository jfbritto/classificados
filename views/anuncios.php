<div class="container">
	<h1>Meus anúncios</h1>

	<a href="<?php echo BASE_URL; ?>anuncios/addAnuncio" class="btn btn-default">Adicionar anúncio</a>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Foto</th>
				<th>Título</th>
				<th>Valor</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php
			

			foreach($anuncios as $anuncio){
				?>
					<tr>
						<td>	
							<?php if(!empty($anuncio['url'])):?>
							<img src="assets/img/anuncios/<?php echo $anuncio['url']?>" border="0" height="50">
							<?php else:?>
							<img src="assets/img/anuncios/default.png" border="0" height="50">	
							<?php endif;?>	
						</td>
						<td><?php echo $anuncio['titulo']?></td>
						<td>R$ <?php echo number_format($anuncio['valor'], 2,',','.')?></td>
						<td>
							<a href="<?php echo BASE_URL; ?>anuncios/edit/<?php echo $anuncio['id']?>" class="btn btn-warning">Editar</a>
							<a href="<?php echo BASE_URL; ?>anuncios/excluirAnuncio/<?php echo $anuncio['id']?>" class="btn btn-danger">Excluir</a>
						</td>
					</tr>
				<?php
			}

		?>
		</tbody>
	</table>

</div>