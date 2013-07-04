
	<div class="row">
	
		<div class="span8">
		
			<p><a href="<?php echo URL; ?>index.php?url=cursuri/cursurile_mele" class="btn">inapoi la cursuri</a></p>
		
			<h3>Adauga utilizatori la curs</h3>
			
			<table cellspacing="0" cellpadding="0" width="100%" border="0">
				<?php
				if( !empty($studenti) ) {
				foreach( $studenti as $student ) {
				?>
				<tr>
					<td>
						<label class="checkbox">
							<input type="checkbox" id="student_<?php echo $id_curs,'_',$student['id_utilizator']; ?>" value="1" <?php echo in_array($student['id_utilizator'], $utilizatori_curs) ? 'checked="checked"' : ''; ?> /> <?php echo $student['nume']; ?>
						</label>
					</td>
				</tr>
				<?php
				}
				}
				?>
			</table>
			
		
		</div>
	
	</div>
	
	<script>
	$('input[id^=student_]').on('click', function() {
		var exp  = $(this).attr('id').split('student_');
		var expp = exp[1].split('_'); 
		var id_curs       = expp[0];
		var id_utilizator = expp[1];
		var activat = $(this).is(':checked') ? 1 : 0;
		$.ajax({
			url: "<?php echo URL; ?>index.php?url=cursuri/ajax_adauga_utilizator_curs",
			type: "POST",
			dataType: 'json',
			data: {
				id_curs: id_curs,
				id_utilizator: id_utilizator,
				activat: activat
			},
			beforeSend: function() {
				$('input[id^=student_]').attr('disabled', 'disabled');
			},
			cache: false,
			success: function(data) {
				if( data.error == 'false' ) {
					//
				} else {
					alert('A intervenit o eroare in momentul salvarii datelor!');
				}
				$('input[id^=student_]').removeAttr('disabled');
			}
		});
	});
	</script>