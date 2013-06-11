
	<div class="row">
	
		<div class="span8">
		
			<h3>Adauga utilizator <small>campurile marcate cu * sunt obligatorii</small></h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=utilizator/adauga" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="rol" class="control-label">Rol *</label>
						<div class="controls">
							<select name="rol" id="rol">
								<option value="">- alege rol -</option>
								<?php
								foreach( $roluri as $rol ) {
									echo '<option value="'.$rol['id_rol'].'" '.(isset($_POST['rol']) && $_POST['rol'] == $rol['nume_rol'] ? 'selected="selected"' : '').'>'.$rol['nume_rol'].'</option>';
								}
								?>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label for="email" class="control-label">Email *</label>
						<div class="controls">
							<input type="text" id="email" placeholder="" name="email" class="span6" value="<?php echo isset($_POST['email']) ? htmlspecialchars(strip_tags($_POST['email'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="username" class="control-label">Username *</label>
						<div class="controls">
							<input type="text" id="username" placeholder="" name="username" class="span6" value="<?php echo isset($_POST['username']) ? htmlspecialchars(strip_tags($_POST['username'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="parola" class="control-label">Parola *</label>
						<div class="controls">
							<input type="password" id="parola" placeholder="" name="parola" class="span6" value="<?php echo isset($_POST['parola']) ? htmlspecialchars(strip_tags($_POST['parola'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="nume" class="control-label">Prenume si nume *</label>
						<div class="controls">
							<input type="text" id="nume" placeholder="Prenume Nume" name="nume" class="span6" value="<?php echo isset($_POST['nume']) ? htmlspecialchars(strip_tags($_POST['nume'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="telefon" class="control-label">Telefon</label>
						<div class="controls">
							<input type="text" id="telefon" placeholder="" name="telefon" class="span6" value="<?php echo isset($_POST['telefon']) ? htmlspecialchars(strip_tags($_POST['telefon'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="localitate" class="control-label">Localitate</label>
						<div class="controls">
							<input type="text" id="localitate" placeholder="" name="localitate" class="span6" value="<?php echo isset($_POST['localitate']) ? htmlspecialchars(strip_tags($_POST['localitate'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="adresa" class="control-label">Adresa</label>
						<div class="controls">
							<input type="text" id="adresa" placeholder="" name="adresa" class="span6" value="<?php echo isset($_POST['adresa']) ? htmlspecialchars(strip_tags($_POST['adresa'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Salveaza</button>
					</div>
				</fieldset>
			</form>
			
		</div>
	
	</div>