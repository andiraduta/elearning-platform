﻿<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>E-Learning</title>

<link href="<?php echo URL; ?>media/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo URL; ?>media/css/style.css" rel="stylesheet">
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="#">E-Learning</a>
			<div class="nav-collapse collapse">
				<p class="navbar-text pull-right">
				Bine ai venit <a href="#" class="navbar-link">Vizitator</a>
				</p>
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>

<div class="container">

	<div class="row">
		<div class="span3">
			<div class="well">
				<form class="form-signin">
				<h4>Intră în cont</h4>
				<input type="text" class="input-block-level" name="username" placeholder="Adresa email">
				<input type="password" class="input-block-level" name="password" placeholder="Parolă">
				<button class="btn btn-primary" type="submit">Intră</button>
				</form>
			</div>
		
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<li class="nav-header">Sidebar</li>
					<li class="active"><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li class="nav-header">Sidebar</li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li class="nav-header">Sidebar</li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
				</ul>
			</div>
			
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<li class="nav-header">Cursuri</li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon icon-list"></i>Toate cursurile</a></li>
				</ul>
			</div>
		</div><!--/span-->
		
		<div class="span9">
			<div class="hero-unit">
				<h1>Bine aţi venit!</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula lacinia leo, ac blandit odio cursus in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam varius, arcu a sollicitudin laoreet, nisi justo placerat mi, elementum interdum nisl odio faucibus nisl.</p>
				<p><a href="#" class="btn btn-primary btn-large">Vezi lista de cursuri &raquo;</a></p>
			</div>
		</div>
	</div>
	
</div>

</div>

</body>
</html>