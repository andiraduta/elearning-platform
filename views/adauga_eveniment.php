
	<div class="row">
	
		<div class="span8">
		
			<h3>Adauga eveniment</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/adauga_eveniment/<?php echo $id_curs; ?>" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="titlu" class="control-label">Titlu</label>
						<div class="controls">
							<input type="text" id="titlu" placeholder="" name="titlu" class="span6" value="<?php echo isset($_POST['titlu']) ? htmlspecialchars(strip_tags($_POST['titlu'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="data" class="control-label">Data eveniment</label>
						<div class="controls">
							<input type="text" id="data" placeholder="zz-ll-aaaa" name="data" class="span6" value="<?php echo isset($_POST['data']) ? htmlspecialchars(strip_tags($_POST['data'])) : ''; ?>" />
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