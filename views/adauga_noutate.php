
	<div class="row">
	
		<div class="span8">
		
			<h3>Adauga noutate / anunt</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=noutati/adauga" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="titlu" class="control-label">Titlu</label>
						<div class="controls">
							<input type="text" id="titlu" placeholder="" name="titlu" class="span6" value="<?php echo isset($_POST['titlu']) ? htmlspecialchars(strip_tags($_POST['titlu'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="anunt" class="control-label">Text anunt</label>
						<div class="controls">
							<textarea name="anunt" id="anunt" class="span6" cols="30" rows="10">
							<?php echo isset($_POST['titlu']) ? htmlspecialchars(strip_tags($_POST['titlu'])) : ''; ?>
							</textarea>
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Salveaza</button>
					</div>
				</fieldset>
			</form>
		
		</div>
	
	</div>
	
	<script>
	$('#anunt').wysihtml5();
	</script>