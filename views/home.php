	<div class="container-fluid">
		<div class="jumbotron">
			<h2>Nós temos <?php echo $total_anuncios; ?> anúncios</h2>
			<p>E mais de <?php echo $total_usuarios; ?> usuários cadastrados.</p>
		</div>
		
		<div class="row">
			<div class="col-sm-3">
				<h4>Pesquisa avançada</h4>
				<form method="GET">
					<div class="form-group">
						<label for="categoria">Categoria:</label>
						<select id="categoria" name="filtros[categoria]" class="form-control">
							<option></option>
							<?php foreach($categorias as $categoria):?>
								<option value="<?php echo $categoria['id'];?>" <?php echo ($categoria['id']==$filtros['categoria'])?'selected="selected"':''; ?>><?php echo utf8_encode($categoria['nome']);?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="preco">Preço:</label>
						<select id="preco" name="filtros[preco]" class="form-control">
							<option></option>
							<option value="0-50" <?php echo ($filtros['preco']=='0-50')?'selected="selected"':''; ?>>R$ 0-50</option>
							<option value="51-100" <?php echo ($filtros['preco']=='51-100')?'selected="selected"':''; ?>>R$ 51-100</option>
							<option value="101-200" <?php echo ($filtros['preco']=='101-200')?'selected="selected"':''; ?>>R$ 101-200</option>
							<option value="201-500" <?php echo ($filtros['preco']=='201-500')?'selected="selected"':''; ?>>R$ 201-500</option>
							<option value="501-1000" <?php echo ($filtros['preco']=='501-1000')?'selected="selected"':''; ?>>R$ 501-1000</option>

						</select>
					</div>
					<div class="form-group">
						<label for="estado">Estado de conservação:</label>
						<select id="estado" name="filtros[estado]" class="form-control">
							<option></option>
							<option value="0" <?php echo ($filtros['estado']=='0')?'selected="selected"':''; ?>>Ruim</option>
							<option value="1" <?php echo ($filtros['estado']=='1')?'selected="selected"':''; ?>>Bom</option>
							<option value="2" <?php echo ($filtros['estado']=='2')?'selected="selected"':''; ?>>Ótimo</option>

						</select>
					</div>

					<div class="form-group">
						<button class="btn btn-info">Buscar</button>
					</div>
				</form>
			</div>
			<div class="col-sm-9">
				<h4>Últimos anúncios</h4>
				<table class="table table-striped table-hover">
					<tbody>
						<?php foreach($anuncios as $anuncio){?>
							<tr>
								<td>	
									<div class="foto_item2">
									<?php if(!empty($anuncio['url'])):?>
										<img class="img img-thumbnail" src="<?php echo BASE_URL; ?>assets/img/anuncios/<?php echo $anuncio['url']?>" border="0">
									<?php else:?>
										<img class="img img-thumbnail" src="<?php echo BASE_URL; ?>assets/img/anuncios/default.png" border="0">	
									<?php endif;?>	
									</div>
								</td>
								<td>
									<a href="<?php echo BASE_URL; ?>produto/abrir/<?php echo $anuncio['id']?>"><?php echo $anuncio['titulo']?></a><br>
									<?php echo utf8_encode($anuncio['categoria']) ?>
								</td>
								<td>
									<b>R$ <?php echo number_format($anuncio['valor'], 2,',','.')?></b>
								</td>
							</tr>
						<?php }?>
					</tbody>
				</table>

				<ul class="pagination">
					<?php for ($q=1; $q <= $total_paginas; $q++) { ?> 
						<li class="<?php echo ($p==$q)?'active':''; ?>"><a href="<?php echo BASE_URL; ?>?<?php 
						$w = $_GET;
						$w['p'] = $q;
						echo http_build_query($w); 
						?>"><?php echo $q; ?></a></li>
					<?php } ?>
				</ul>

			</div>
		</div>
	</div>
