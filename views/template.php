<!DOCTYPE html>
<html>
<head>
	<title>Classificados</title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css">
	
</head>
<body>

	<nav  class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="<?php echo BASE_URL; ?>" class="navbar-brand">Classificados</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php if(isset($_SESSION['clogin']) && !empty($_SESSION['clogin'])): ?>
					<li class="nav-item dropdown">
						<a data-toggle="dropdown" href=""><?php $u=new Usuarios();echo $u->nomeUsu($_SESSION['clogin']);?></a>
						<div class="dropdown-menu"  style="padding: 5px;">
							<a class="btn btn-primary btn-block dropdown-item" href="<?php echo BASE_URL; ?>anuncios">Meus anúncios</a>
							<a class="btn btn-danger btn-block dropdown-item" href="<?php echo BASE_URL; ?>login/sair">Sair</a>
						</div>
					</li>
				<?php else: ?>
					<li><a href="<?php echo BASE_URL; ?>cadastrar">Cadastre-se</a></li>
					<li><a href="<?php echo BASE_URL; ?>login">Login</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>



	<?php $this->loadViewInTemplate($viewName, $viewData); ?>

	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>
</html>