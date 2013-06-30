
	<div class="row">
	
		<div class="span8">
		
			<h2>Cursurile mele <!--<small>cursuri in care sunt inrolat</small>--></h2>
			
			<?php
			if(!empty($cursuri)) {
				foreach($cursuri as $curs) {
				?>
				<div>
					<h3><a href="<?php echo URL; ?>index.php?url=cursuri/curs/<?php echo $curs['id_curs']; ?>"><?php echo $curs['titlu']; ?></a></h3>
					<p><strong>Profesor:</strong> <?php echo $curs['nume']; ?></p>
					<?php if(are_rol('administrator') || are_rol('profesor')) { ?>
					<p>
						<?php if(are_rol('administrator')) { ?>
						<a href="<?php echo URL; ?>index.php?url=cursuri/adauga_utilizatori_curs/<?php echo $curs['id_curs']; ?>" class="btn">Adauga cursanti</a> 
						<?php } ?>
						
						<?php if(are_rol('administrator') || are_rol('profesor')) { ?>
						<a href="<?php echo URL; ?>index.php?url=cursuri/adauga_eveniment/<?php echo $curs['id_curs']; ?>" class="btn">Adauga eveniment</a> 
						<?php } ?>
					</p>
					<?php } ?>
				</div>
				
				<hr />
				<?php
				}
			} else {
				echo '<p>Nu exista cursuri.</p>';
			}
			?>
		
		</div>
	
	</div>