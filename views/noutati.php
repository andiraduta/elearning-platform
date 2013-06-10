
	<div class="row">
	
		<div class="span8">
		
			<h3>Noutati</h3>
			
			<?php if( are_rol('administrator') ) { ?>
			<p><a href="<?php echo URL . 'index.php?url=noutati/adauga'; ?>" class="btn btn-primary">Adauga anunt</a></p>
			<br />
			<?php } ?>
			
			<?php
			if( !empty($noutati) ) {
			
				foreach($noutati as $noutate) {
				?>
				<div>
					<h4><?php echo $noutate['titlu']; ?></h4>
					<p><small>postat de <strong><?php echo $noutate['nume']; ?></strong> - <?php echo date('d.m.Y', strtotime($noutate['data_creare'])); ?></small></p>
					<p><?php echo $noutate['text']; ?></p>
				</div>
				
				<hr />
				<?php
				}
			
			} else {
			?>
			<p>Nu exista anunturi.</p>
			<?php
			}
			?>
		
		</div>
	
	</div>