
	<div class="row">
	
		<div class="span8">
		
			<p><a href="<?php echo URL; ?>index.php?url=utilizator/contul_meu" class="btn">&laquo; inapoi la profil</a></p>
		
			<h3>Schimbare parola <small>campurile marcate cu * sunt obligatorii</small></h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=utilizator/schimba_parola" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="parola" class="control-label">Parola noua *</label>
						<div class="controls">
							<input type="password" id="parola" placeholder="" name="parola" class="span6" value="<?php echo isset($utilizator['parola']) ? htmlspecialchars(strip_tags($utilizator['parola'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="confirma_parola" class="control-label">Confirma parola noua *</label>
						<div class="controls">
							<input type="password" id="confirma_parola" name="confirma_parola" class="span6" value="<?php echo isset($utilizator['confirma_parola']) ? htmlspecialchars(strip_tags($utilizator['confirma_parola'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Salveaza</button>
					</div>
				</fieldset>
			</form>
			
		</div>
	
	</div>