<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-Frame-Options" content="deny">
		<base href="<?php $this->eprint($this->ROOT_URL); ?>" />
		<title><?php $this->eprint($this->title); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="sistema" />
		<meta name="author" content="phreeze builder | phreeze.com" />

		<!-- Le styles -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="styles/style.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet" />
		<!--[if IE 7]>
		<link rel="stylesheet" href="bootstrap/css/font-awesome-ie7.min.css">
		<![endif]-->
		<link href="bootstrap/css/datepicker.css" rel="stylesheet" />
		<link href="bootstrap/css/timepicker.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-combobox.css" rel="stylesheet" />
		
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />

		<script type="text/javascript" src="scripts/libs/LAB.min.js"></script>
		<script type="text/javascript">
			$LAB.script("//code.jquery.com/jquery-1.8.2.min.js").wait()
				.script("bootstrap/js/bootstrap.min.js")
				.script("bootstrap/js/bootstrap-datepicker.js")
				.script("bootstrap/js/bootstrap-timepicker.js")
				.script("bootstrap/js/bootstrap-combobox.js")
				.script("scripts/libs/underscore-min.js").wait()
				.script("scripts/libs/underscore.date.min.js")
				.script("scripts/libs/backbone-min.js")
				.script("scripts/app.js")
				.script("scripts/model.js").wait()
				.script("scripts/view.js").wait()
		</script>

	</head>

	<body>

			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="./">sistema</a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li <?php if ($this->nav=='enderecos') { echo 'class="active"'; } ?>><a href="./enderecos">enderecos</a></li>
								<li <?php if ($this->nav=='authorities') { echo 'class="active"'; } ?>><a href="./authorities">authorities</a></li>
								<li <?php if ($this->nav=='autoroles') { echo 'class="active"'; } ?>><a href="./autoroles">autoroles</a></li>
								<li <?php if ($this->nav=='cidades') { echo 'class="active"'; } ?>><a href="./cidades">cidades</a></li>
							</ul>
							<ul class="nav">
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
								<ul class="dropdown-menu">
								<li <?php if ($this->nav=='contatos') { echo 'class="active"'; } ?>><a href="./contatos">contatos</a></li>
								<li <?php if ($this->nav=='paises') { echo 'class="active"'; } ?>><a href="./paises">paises</a></li>
								<li <?php if ($this->nav=='criadores') { echo 'class="active"'; } ?>><a href="./criadores">criadores</a></li>
								<li <?php if ($this->nav=='creator_award_honours') { echo 'class="active"'; } ?>><a href="./creator_award_honours">creator_award_honours</a></li>
								<li <?php if ($this->nav=='contatos_criadores') { echo 'class="active"'; } ?>><a href="./contatos_criadores">contatos_criadores</a></li>
								<li <?php if ($this->nav=='historico_criadores') { echo 'class="active"'; } ?>><a href="./historico_criadores">historico_criadores</a></li>
								<li <?php if ($this->nav=='referencias_criadores') { echo 'class="active"'; } ?>><a href="./referencias_criadores">referencias_criadores</a></li>
								<li <?php if ($this->nav=='nome_criadores') { echo 'class="active"'; } ?>><a href="./nome_criadores">nome_criadores</a></li>
								<li <?php if ($this->nav=='datalogs') { echo 'class="active"'; } ?>><a href="./datalogs">datalogs</a></li>
								<li <?php if ($this->nav=='dimensoes') { echo 'class="active"'; } ?>><a href="./dimensoes">dimensoes</a></li>
								<li <?php if ($this->nav=='documentos') { echo 'class="active"'; } ?>><a href="./documentos">documentos</a></li>
								<li <?php if ($this->nav=='documentos_midias') { echo 'class="active"'; } ?>><a href="./documentos_midias">documentos_midias</a></li>
								<li <?php if ($this->nav=='expo_items') { echo 'class="active"'; } ?>><a href="./expo_items">expo_items</a></li>
								<li <?php if ($this->nav=='exposicoes') { echo 'class="active"'; } ?>><a href="./exposicoes">exposicoes</a></li>
								<li <?php if ($this->nav=='exposicao_criadores') { echo 'class="active"'; } ?>><a href="./exposicao_criadores">exposicao_criadores</a></li>
								<li <?php if ($this->nav=='dimensao_exposicoes') { echo 'class="active"'; } ?>><a href="./dimensao_exposicoes">dimensao_exposicoes</a></li>
								<li <?php if ($this->nav=='exposicao_historicos') { echo 'class="active"'; } ?>><a href="./exposicao_historicos">exposicao_historicos</a></li>
								<li <?php if ($this->nav=='locais_exposicoes') { echo 'class="active"'; } ?>><a href="./locais_exposicoes">locais_exposicoes</a></li>
								<li <?php if ($this->nav=='referencia_exposicoes') { echo 'class="active"'; } ?>><a href="./referencia_exposicoes">referencia_exposicoes</a></li>
								<li <?php if ($this->nav=='fundos') { echo 'class="active"'; } ?>><a href="./fundos">fundos</a></li>
								<li <?php if ($this->nav=='niveis_fundos') { echo 'class="active"'; } ?>><a href="./niveis_fundos">niveis_fundos</a></li>
								<li <?php if ($this->nav=='historicos') { echo 'class="active"'; } ?>><a href="./historicos">historicos</a></li>
								<li <?php if ($this->nav=='midia_historicos') { echo 'class="active"'; } ?>><a href="./midia_historicos">midia_historicos</a></li>
								<li <?php if ($this->nav=='possuidores') { echo 'class="active"'; } ?>><a href="./possuidores">possuidores</a></li>
								<li <?php if ($this->nav=='instituicoes') { echo 'class="active"'; } ?>><a href="./instituicoes">instituicoes</a></li>
								<li <?php if ($this->nav=='niveis_instituicoes') { echo 'class="active"'; } ?>><a href="./niveis_instituicoes">niveis_instituicoes</a></li>
								<li <?php if ($this->nav=='midia_instituicoes') { echo 'class="active"'; } ?>><a href="./midia_instituicoes">midia_instituicoes</a></li>
								<li <?php if ($this->nav=='items') { echo 'class="active"'; } ?>><a href="./items">items</a></li>
								<li <?php if ($this->nav=='item_midias') { echo 'class="active"'; } ?>><a href="./item_midias">item_midias</a></li>
								<li <?php if ($this->nav=='criadores_items') { echo 'class="active"'; } ?>><a href="./criadores_items">criadores_items</a></li>
								<li <?php if ($this->nav=='descricoes_items') { echo 'class="active"'; } ?>><a href="./descricoes_items">descricoes_items</a></li>
								<li <?php if ($this->nav=='dimensoes_items') { echo 'class="active"'; } ?>><a href="./dimensoes_items">dimensoes_items</a></li>
								<li <?php if ($this->nav=='descricao_items') { echo 'class="active"'; } ?>><a href="./descricao_items">descricao_items</a></li>
								<li <?php if ($this->nav=='niveis') { echo 'class="active"'; } ?>><a href="./niveis">niveis</a></li>
								<li <?php if ($this->nav=='midias') { echo 'class="active"'; } ?>><a href="./midias">midias</a></li>
								<li <?php if ($this->nav=='modulos') { echo 'class="active"'; } ?>><a href="./modulos">modulos</a></li>
								<li <?php if ($this->nav=='n_contatos') { echo 'class="active"'; } ?>><a href="./n_contatos">n_contatos</a></li>
								<li <?php if ($this->nav=='n_historicos') { echo 'class="active"'; } ?>><a href="./n_historicos">n_historicos</a></li>
								<li <?php if ($this->nav=='n_referencias') { echo 'class="active"'; } ?>><a href="./n_referencias">n_referencias</a></li>
								<li <?php if ($this->nav=='descricoes_fisicas') { echo 'class="active"'; } ?>><a href="./descricoes_fisicas">descricoes_fisicas</a></li>
								<li <?php if ($this->nav=='locais') { echo 'class="active"'; } ?>><a href="./locais">locais</a></li>
								<li <?php if ($this->nav=='referencias') { echo 'class="active"'; } ?>><a href="./referencias">referencias</a></li>
								<li <?php if ($this->nav=='midia_referencias') { echo 'class="active"'; } ?>><a href="./midia_referencias">midia_referencias</a></li>
								<li <?php if ($this->nav=='relacionamento_items') { echo 'class="active"'; } ?>><a href="./relacionamento_items">relacionamento_items</a></li>
								<li <?php if ($this->nav=='papeis') { echo 'class="active"'; } ?>><a href="./papeis">papeis</a></li>
								<li <?php if ($this->nav=='buscas') { echo 'class="active"'; } ?>><a href="./buscas">buscas</a></li>
								<li <?php if ($this->nav=='estados') { echo 'class="active"'; } ?>><a href="./estados">estados</a></li>
								<li <?php if ($this->nav=='armazenamentos') { echo 'class="active"'; } ?>><a href="./armazenamentos">armazenamentos</a></li>
								<li <?php if ($this->nav=='midia_armazenamentos') { echo 'class="active"'; } ?>><a href="./midia_armazenamentos">midia_armazenamentos</a></li>
								<li <?php if ($this->nav=='timezones') { echo 'class="active"'; } ?>><a href="./timezones">timezones</a></li>
								<li <?php if ($this->nav=='titulos') { echo 'class="active"'; } ?>><a href="./titulos">titulos</a></li>
								<li <?php if ($this->nav=='transcricoes') { echo 'class="active"'; } ?>><a href="./transcricoes">transcricoes</a></li>
								<li <?php if ($this->nav=='usuarios') { echo 'class="active"'; } ?>><a href="./usuarios">usuarios</a></li>
								<li <?php if ($this->nav=='papeis_usuarios') { echo 'class="active"'; } ?>><a href="./papeis_usuarios">papeis_usuarios</a></li>
								</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-lock"></i> Login <i class="caret"></i></a>
								<ul class="dropdown-menu">
									<li><a href="./loginform">Login</a></li>
									<li class="divider"></li>
									<li><a href="./secureuser">Example User Page <i class="icon-lock"></i></a></li>
									<li><a href="./secureadmin">Example Admin Page <i class="icon-lock"></i></a></li>
								</ul>
								</li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>
			</div>