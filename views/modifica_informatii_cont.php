
	<div class="row">
	
		<div class="span8">
		
			<p><a href="<?php echo URL; ?>index.php?url=utilizator/contul_meu" class="btn">&laquo; inapoi la profil</a></p>
		
			<h3>Actualizare informatii cont <small>campurile marcate cu * sunt obligatorii</small></h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=utilizator/actualizare_cont" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls">Username: <?php echo $utilizator['username']; ?></div>
					</div>
					
					<div class="control-group">
						<label for="email" class="control-label">Email *</label>
						<div class="controls">
							<input type="text" id="email" placeholder="" name="email" class="span6" value="<?php echo isset($utilizator['email']) ? htmlspecialchars(strip_tags($utilizator['email'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="nume" class="control-label">Prenume si nume *</label>
						<div class="controls">
							<input type="text" id="nume" placeholder="Prenume Nume" name="nume" class="span6" value="<?php echo isset($utilizator['nume']) ? htmlspecialchars(strip_tags($utilizator['nume'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="telefon" class="control-label">Telefon</label>
						<div class="controls">
							<input type="text" id="telefon" placeholder="" name="telefon" class="span6" value="<?php echo isset($utilizator['telefon']) ? htmlspecialchars(strip_tags($utilizator['telefon'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="localitate" class="control-label">Localitate</label>
						<div class="controls">
							<input type="text" id="localitate" placeholder="" name="localitate" class="span6" value="<?php echo isset($utilizator['localitate']) ? htmlspecialchars(strip_tags($utilizator['localitate'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="adresa" class="control-label">Adresa</label>
						<div class="controls">
							<input type="text" id="adresa" placeholder="" name="adresa" class="span6" value="<?php echo isset($utilizator['adresa']) ? htmlspecialchars(strip_tags($utilizator['adresa'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Salveaza</button>
					</div>
				</fieldset>
			</form>
			
		</div>
	
	</div>