
	<div class="row">
	
		<div class="span8">
			
			<p><a href="<?php echo URL; ?>index.php?url=cursuri/curs/<?php echo $id_curs; ?>" class="btn">inapoi la curs</a></p>
		
			<h3>Adauga fisier</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/adauga_activitate_fisier/<?php echo $id_curs,'_',$id_tip_activitate; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="titlu" class="control-label">Titlu activitate</label>
						<div class="controls">
							<input type="text" name="titlu" id="titlu" class="span6" value="<?php echo isset($_POST['titlu']) ? $_POST['titlu'] : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="descriere" class="control-label">Descriere fisier</label>
						<div class="controls">
							<input type="text" name="descriere" id="descriere" class="span6" value="<?php echo isset($_POST['descriere']) ? $_POST['descriere'] : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="fisier" class="control-label">Alege fisier</label>
						<div class="controls">
							<input type="file" name="fisier" id="fisier" class="span6" value="<?php echo isset($_POST['fisier']) ? $_POST['fisier'] : ''; ?>" /> <small>max. 2MB - gif, jpg, jpeg, png, doc, docx, pdf, xls, xlsx, ppt, pptx, txt</small>
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Salveaza</button>
					</div>
				</fieldset>
			</form>
		
		</div>
	
	</div>