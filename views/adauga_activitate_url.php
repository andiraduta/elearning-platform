
	<div class="row">
	
		<div class="span8">
		
			<h3>Adauga url</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/adauga_activitate_url/<?php echo $id_curs,'_',$id_tip_activitate; ?>" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="titlu" class="control-label">Titlu activitate</label>
						<div class="controls">
							<input type="text" name="titlu" id="titlu" class="span6" value="<?php echo isset($_POST['titlu']) ? $_POST['titlu'] : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="nume_url" class="control-label">Nume url</label>
						<div class="controls">
							<input type="text" name="nume_url" id="nume_url" class="span6" value="<?php echo isset($_POST['nume_url']) ? $_POST['nume_url'] : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="url" class="control-label">Url</label>
						<div class="controls">
							<input type="text" name="url" id="url" placeholder="http://www.exemplu.ro" class="span6" value="<?php echo isset($_POST['url']) ? $_POST['url'] : ''; ?>" />
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Salveaza</button>
					</div>
				</fieldset>
			</form>
		
		</div>
	
	</div>