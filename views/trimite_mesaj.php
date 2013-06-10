
	<div class="row">
	
		<div class="span8">
		
			<h3>Trimite mesaj</h3>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<form action="<?php echo URL; ?>index.php?url=mesaje/trimite_mesaj" method="POST" class="form-horizontal">
				<fieldset>
				
					<div class="control-group">
						<label for="destinatar" class="control-label">Destinatar</label>
						<div class="controls">
							<input type="text" id="destinatar" placeholder="introduceti nume utilizator..." name="destinatar" class="span6" value="<?php echo isset($_POST['destinatar']) ? htmlspecialchars(strip_tags($_POST['destinatar'])) : ''; ?>" />
							<input type="hidden" id="destinatar_id" name="id_destinatar" value="<?php echo isset($_POST['id_destinatar']) ? htmlspecialchars(strip_tags($_POST['id_destinatar'])) : ''; ?>" />
							
						</div>
					</div>
					
					<div class="control-group">
						<label for="subiect" class="control-label">Subiect</label>
						<div class="controls">
							<input type="text" id="subiect" placeholder="" name="subiect" class="span6" value="<?php echo isset($_POST['subiect']) ? htmlspecialchars(strip_tags($_POST['subiect'])) : ''; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="mesaj" class="control-label">Mesaj</label>
						<div class="controls">
							<textarea name="mesaj" id="mesaj" class="span6" cols="30" rows="10">
							<?php echo isset($_POST['mesaj']) ? htmlspecialchars(strip_tags($_POST['mesaj'])) : ''; ?>
							</textarea>
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" name="trimite" type="submit">Trimite</button>
					</div>
				</fieldset>
			</form>
		
		</div>
	
	</div>
	
	<script>
	$('#mesaj').wysihtml5();
	
	$('#destinatar').autocomplete({
		source: function(request, response) {
			$.ajax({
				url: 'index.php?url=mesaje/cauta_destinatar/'+request.term,
				dataType: "json",
				success: function(data) {
					response($.map(data, function(item) {
					return {
						label: item.value,
						value: item.value,
						id: item.id
					}
					}));
				}
			});
		},
		minLength: 2,
		select: function(event, ui) {
			$('#destinatar').val(ui.item.value);
			$('#destinatar_id').val(ui.item.id);
		}
	});
	</script>