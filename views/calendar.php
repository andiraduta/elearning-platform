	<script>
	$(function() {
		$.datepicker.setDefaults($.datepicker.regional['ro']);
		
		<?php
		$date = array();
		$descrieri = array();
		if(!empty($evenimente)) {
			foreach($evenimente as $eveniment) {
				$date[] = "'".date('Y/m/d', strtotime($eveniment['data_eveniment']))."'";
				$descrieri[] = "'".$eveniment['titlu']."'";
			}
		}
		?>
		var dates = [<?php echo implode(',', $date); ?>];
		var tips  = [<?php echo implode(',', $descrieri); ?>];
		
		$( "#datepicker" ).datepicker({
			dateFormat: 'dd-mm-yy',
			numberOfMonths: 2,
			beforeShowDay: highlightDays,
		});
		
		function highlightDays(date) {
			for (var i = 0; i < dates.length; i++) {
				console.log(new Date(dates[i]).toString());
				if (new Date(dates[i]).toString() == date.toString()) {              
					return [true, 'highlight', tips[i]];
				}
			}
			return [true, ''];
		} 
	});
	</script>

	<div class="row">
	
		<div class="span8">
		
			<h2>Calendar evenimente</h2>
			
			<ul>
				<?php
				if(!empty($evenimente)) {
					foreach($evenimente as $eveniment) {
					?>
					<li><?php echo date('d-m-Y', strtotime($eveniment['data_eveniment'])),' - ', $eveniment['titlu'], ' (Curs: ', $eveniment['curs'], ')'; ?></li>
					<?php
					}
				} else {
					echo '<li>Nu exista evenimente, inca.</li>';
				}
				?>
			</ul>
		
			<div id="datepicker"></div>
		
		</div>
	
	</div>
