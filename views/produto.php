	


<div class="container-fluid">

	
	<div class="row">
		<div class="col-sm-5">
				
			<div class="carousel slide" data-ride="carousel" id="meuCarousel">
				<div class="carousel-inner" role="listbox">
					<?php foreach($info['fotos'] as $chave => $foto):?>

						<div class="item <?php echo ($chave=='0')?'active':''; ?>">
							<center>
								
							<img class="img img-responsive" src="<?php echo BASE_URL; ?>assets/img/anuncios/<?php echo $foto['url']; ?>">
							</center>

						</div>

					<?php endforeach; ?>
				</div>
				<a class="left carousel-control" href="#meuCarousel" role="button" data-slide="prev"><span><</span></a>
				<a class="right carousel-control" href="#meuCarousel" role="button" data-slide="next"><span>></span></a>
			</div>	
			<br>

		</div>
		<div class="col-sm-7">
			<div class="jumbotron">
			<h2><b><?php echo $info['titulo']?></b></h2>
			<h4><?php echo utf8_encode($info['categoria'])?></h4>
			<p><?php echo $info['descricao']?></p>
			<br>
			<h4><b>R$ <?php echo number_format($info['valor'], 2,',','.')?></b></h4>
			<h3><?php echo $info['nome']?></h3>
			<h3><?php echo $info['telefone']?></h3>
			</div>
		</div>
	</div>
</div>
