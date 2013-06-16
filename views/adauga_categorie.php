
	<div class="row">
	
		<div class="span8">
		
			<h3>Adauga categorie</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/adauga_categorie" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="parinte" class="control-label">Parinte</label>
						<div class="controls">
							<select name="parinte" id="parinte">
								<option value="">-fara parinte-</option>
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