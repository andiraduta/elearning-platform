
	<div class="row">
	
		<div class="span8">
		
			<p><a href="<?php echo URL; ?>index.php?url=cursuri/categorii" class="btn">Inapoi la categorii</a></p>
		
			<h3>Modifica categorie</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/modifica_categorie/<?php echo $id_categorie; ?>" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="parinte" class="control-label">Parinte</label>
						<div class="controls">
							<select name="parinte" id="parinte">
								<option value="">-fara parinte-</option>
								<?php
								function afiseaza_categorii($categorii_cursuri, $nivel = 0) {
									global $detalii_categorie;print_r($detalii_categorie);
									$afiseaza = '';
									foreach($categorii_cursuri as $categorie) {
										$afiseaza .= '<option value="'.$categorie['id_categorie'].'" '.($detalii_categorie['id_categorie'] == $categorie['id_categorie'] ? 'selected="selected"' : '').'>'.($nivel > 0 ? str_repeat('-', $nivel*2).' ' : '') . $categorie['titlu'].'</option>';
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
							<input type="text" id="titlu" placeholder="" name="titlu" class="span6" value="<?php echo isset($detalii_categorie['titlu']) ? htmlspecialchars(strip_tags($detalii_categorie['titlu'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="descriere" class="control-label">Descriere</label>
						<div class="controls">
							<textarea name="descriere" id="descriere" class="span6" cols="30" rows="10">
							<?php echo isset($detalii_categorie['descriere']) ? htmlspecialchars(strip_tags($detalii_categorie['descriere'])) : ''; ?>
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