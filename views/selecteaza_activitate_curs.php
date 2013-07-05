
	<div class="row">
	
		<div class="span8">
		
			<h2>Alege tipul de activitate curs</h2>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/adauga_activitate_curs/<?php echo $id_curs; ?>" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="activitate" class="control-label">Tip activitate</label>
						<div class="controls">
							<select name="activitate" id="activitate">
								<option value="">-alege-</option>
								<?php
								if( !empty($tipuri_activitati) ) {
									foreach($tipuri_activitati as $tip) {
										echo '<option value="'.$tip['tip_activitate'].'_'.$tip['id_tip_activitate'].'">'.$tip['tip_activitate'].'</option>';
									}
								}
								?>
							</select>
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="continua" type="submit">Continua</button>
					</div>
				</fieldset>
			</form>
		
		</div>
	
	</div>