<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>E-Learning</title>

<link href="<?php echo URL; ?>media/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo URL; ?>media/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
	<div class="row login-box">
		<div class="span12">
			<div class="span3">&nbsp;</div>
			<div class="span5">
				<p style="text-align: center;"><img src="<?php echo URL; ?>media/images/logo.png" alt="Administrarea sarcinilor de lucru" /></p>
				
				<?php echo isset($msg) ? $msg : ''; ?>
				
				<form action="index.php?url=login/index" method="POST" class="form-horizontal">
					<fieldset>
						<div class="control-group">
							<label for="username" class="control-label">Utilizator</label>
							<div class="controls">
								<input class="span3" id="username" type="text" name="utilizator" value="<?php echo isset($_POST['utilizator']) ? strip_tags($_POST['utilizator']) : ''; ?>" />
							</div>
						</div>
						<div class="control-group">
							<label for="password" class="control-label">Parola</label>
							<div class="controls">
								<input class="span3" id="password" type="password" name="parola" value="<?php echo isset($_POST['parola']) ? strip_tags($_POST['parola']) : ''; ?>" />
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" name="login" class="btn btn-primary"><i class="icon-lock icon-white"></i> Intra in cont</button>
							</div>
						</div>
					</fieldset>
					<div class="clear"></div>
				</form>
			</div>
			<div class="span3">&nbsp;</div>
		</div>
	</div>
</div>

</body>
</html>