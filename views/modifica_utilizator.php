
	<div class="row">
	
		<div class="span8">
		
			<p><a href="<?php echo URL; ?>index.php?url=utilizator" class="btn">&laquo; inapoi la lista</a></p>
		
			<h3>Modifica utilizator <small>campurile marcate cu * sunt obligatorii</small></h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=utilizator/modifica/<?php echo $id_utilizator; ?>" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="rol" class="control-label">Rol *</label>
						<div class="controls">
							<select name="rol" id="rol">
								<option value="">- alege rol -</option>
								<?php
								foreach( $roluri as $rol ) {
									echo '<option value="'.$rol['id_rol'].'" '.(isset($utilizator['id_rol']) && $utilizator['id_rol'] == $rol['id_rol'] ? 'selected="selected"' : '').'>'.$rol['nume_rol'].'</option>';
								}
								?>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label for="email" class="control-label">Email *</label>
						<div class="controls">
							<input type="text" id="email" placeholder="" name="email" class="span6" value="<?php echo isset($utilizator['email']) ? htmlspecialchars(strip_tags($utilizator['email'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="username" class="control-label">Username *</label>
						<div class="controls">
							<input type="text" id="username" placeholder="" name="username" class="span6" value="<?php echo isset($utilizator['username']) ? htmlspecialchars(strip_tags($utilizator['username'])) : ''; ?>" />
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