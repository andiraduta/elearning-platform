
	<div class="row">
	
		<div class="span8">
		
			<h3>Posteaza raspuns</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=cursuri/adauga_postare/<?php echo $id_curs,'_',$id_subiect; ?>" method="POST" class="form-horizontal">
				<fieldset>
					
					<div class="control-group">
						<label for="raspuns" class="control-label">Raspuns</label>
						<div class="controls">
							<textarea name="raspuns" id="raspuns" class="span6" cols="30" rows="10">
							<?php echo isset($_POST['raspuns']) ? htmlspecialchars(strip_tags($_POST['raspuns'])) : ''; ?>
							</textarea>
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="salveaza" type="submit">Raspunde</button>
					</div>
				</fieldset>
			</form>
		
		</div>
	
	</div>
	
	<script>
	$('#raspuns').wysihtml5();
	</script>