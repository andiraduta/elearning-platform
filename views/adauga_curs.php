
	<div class="row">
	
		<div class="span8">
		
			<h3>Adauga curs</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/adauga_curs" method="POST" class="form-horizontal">
				<fieldset>
				
					<div class="control-group">
						<label for="profesor" class="control-label">Profesor *</label>
						<div class="controls">
							<select name="profesor" id="profesor">
							<option value="">-alege profesor-</option>
							<?php
							if(!empty($profesori)) {
								foreach($profesori as $profesor) {
									echo '<option value="'.$profesor['id_utilizator'].'">'.$profesor['nume'].'</option>';
								}
							}
							?>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label for="categorie" class="control-label">Categorie curs *</label>
						<div class="controls">
							<select name="categorie" id="categorie">
								<option value="">-categorie-</option>
								<?php
								function afiseaza_categorii($categorii_cursuri, $nivel = 0) {
									$afiseaza = '';
									foreach($categorii_cursuri as $categorie) {
										$afiseaza .= '<option value="'.$categorie['id_categorie'].'">'.($nivel > 0 ? str_repeat('-', $nivel*2).' ' : '') . $categorie['titlu'].'</option>';
										if( !empty($categorie['subcategorii']) ) {
											if($nivel > 0) {
												$nivel++;
											} else {
												$nivel = 1;
											}
											$afiseaza .= afiseaza_categorii($categorie['subcategorii'], $nivel);
										}
									}
									return $afiseaza;
								}
								
								if( !empty($categorii_cursuri) ) {
									echo afiseaza_categorii($categorii_cursuri, 0);
								}
								?>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label for="titlu" class="control-label">Titlu *</label>
						<div class="controls">
							<input type="text" id="titlu" placeholder="" name="titlu" class="span6" value="<?php echo isset($_POST['titlu']) ? htmlspecialchars(strip_tags($_POST['titlu'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="data_inceput" class="control-label">Data inceput *</label>
						<div class="controls">
							<input type="text" id="data_inceput" placeholder="zz-ll-aaaa" name="data_inceput" class="span6" value="<?php echo isset($_POST['data_inceput']) ? htmlspecialchars(strip_tags($_POST['data_inceput'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="descriere" class="control-label">Descriere</label>
						<div class="controls">
							<textarea name="descriere" id="descriere" class="span6" cols="30" rows="10">
							<?php echo isset($_POST['descriere']) ? htmlspecialchars(strip_tags($_POST['descriere'])) : ''; ?>
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
	$('#descriere').wysihtml5();
	</script>