
	<div class="row">
	
		<div class="span8">
		
			<h3>Adauga rol</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=utilizator/adauga_rol" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="nume_rol" class="control-label">Nume rol</label>
						<div class="controls">
							<input type="text" id="nume_rol" placeholder="" name="nume_rol" class="span6" value="<?php echo isset($_POST['nume_rol']) ? htmlspecialchars(strip_tags($_POST['nume_rol'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Salveaza</button>
					</div>
				</fieldset>
			</form>
		
		</div>
	
	</div>