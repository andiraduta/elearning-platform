
	<div class="row">
	
		<div class="span8">
		
			<h3>Modifica subiect de discutie</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/modifica_subiect_discutie/<?php echo $id_curs; ?>_<?php echo $id_subiect; ?>" method="POST" class="form-horizontal">
				<fieldset>
				
					<div class="control-group">
						<label for="subiect" class="control-label">Subiect de discutie *</label>
						<div class="controls">
							<input type="text" id="subiect" placeholder="" name="subiect" class="span6" value="<?php echo $detalii_subiect['titlu']; ?>" />
						</div>
					</div>

					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Salveaza</button>
					</div>
				</fieldset>
			</form>
		
		</div>
	
	</div>
