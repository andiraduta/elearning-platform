
	<div class="row">
	
		<div class="span8">
			
			<p><a href="<?php echo URL; ?>index.php?url=cursuri/curs/<?php echo $id_curs; ?>" class="btn">inapoi la curs</a></p>
		
			<h3>Modifica lectie</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/modifica_activitate_lectie/<?php echo $id_curs,'_',$id_activitate; ?>" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="titlu" class="control-label">Titlu activitate</label>
						<div class="controls">
							<input type="text" name="titlu" id="titlu" class="span6" value="<?php echo $detalii_activitate['titlu']; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="continut" class="control-label">Continut lectie</label>
						<div class="controls">
							<textarea name="continut" id="continut" class="span6" cols="30" rows="15"><?php echo $detalii_activitate['continut']; ?></textarea>
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
	$('#continut').wysihtml5();
	</script>