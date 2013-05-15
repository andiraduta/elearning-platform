
	<div class="login-box">
			<div class="span1">&nbsp;</div>
			<div class="span5">
				
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
								<button type="submit" name="login" class="btn btn-primary"><i class="icon-lock icon-white"></i> Intră in cont</button>
							</div>
						</div>
					</fieldset>
					<div class="clear"></div>
				</form>
			</div>
			<div class="span2">&nbsp;</div>
		</div>
	</div>