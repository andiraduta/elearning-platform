
	<div class="row">
	
		<div class="span8">
		
			<p><a href="<?php echo URL; ?>index.php?url=utilizator/permisiuni_utilizatori" class="btn">&laquo; inapoi la lista roluri</a></p>
		
			<h3>Modificare permisiuni rol</h3>
			
			<p>Bifati permisiunile care doriti sa fie aplicate acestui rol</p>
		
			<table cellpadding="5" cellspacing="0" width="500">
				<?php
				$pi = 0;
				foreach($permisiuni as $permisiune) {
					echo $pi % 3 == 0 ? '<tr>' : '';
					?>
					<td><input type="checkbox" id="perm_<?php echo $id_rol; ?>_<?php echo $permisiune['id_permisiune']; ?>" value="1" <?php echo array_key_exists($permisiune['id_permisiune'], $permisiuni_rol) ? 'checked="checked"' : ''; ?> /> <?php echo $permisiune['descriere_permisiune']; ?></td>
					<?php
					echo ($pi+1) % 3 == 0 || count($permisiuni) == $pi+1 ? '</tr>' : '';
					$pi++;
				}
				?>
			</table>
			
		</div>
	
	</div>
	
<script>

	$('input[id^=perm_]').on('click', function() {
		var exp  = $(this).attr('id').split('perm_');
		var expp = exp[1].split('_'); 
		var id_rol        = expp[0];
		var id_permisiune = expp[1];
		var activat = $(this).is(':checked') ? 1 : 0;
		$.ajax({
			url: "<?php echo URL; ?>index.php?url=utilizator/ajax_editeaza_permisiune_rol",
			type: "POST",
			dataType: 'json',
			data: {
				id_rol: id_rol,
				id_permisiune: id_permisiune,
				activat: activat
			},
			beforeSend: function() {
				$('input[id^=perm_]').attr('disabled', 'disabled');
			},
			cache: false,
			success: function(data) {
				if( data.error == 'false' ) {
					//
				} else {
					alert('A intervenit o eroare in momentul salvarii datelor!');
				}
				$('input[id^=perm_]').removeAttr('disabled');
			}
		});
	});

</script>