
	<div class="row">
	
		<div class="span8">
		
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
		
			<h2><?php echo $categorie['titlu']; ?></h2>
			<h3>Cursuri</h3>
			
			<?php if( are_rol('administrator') ) { ?>
			<p><a href="<?php echo URL; ?>index.php?url=cursuri/adauga_curs" class="btn btn-success"><i class="icon-plus icon-white"></i> Adauga curs</a> </p>
			<?php } ?>
			
			<?php
			if(!empty($cursuri)) {
				foreach($cursuri as $curs) {
				?>
				<div>
					<h3>
						<a href="<?php echo URL; ?>index.php?url=cursuri/curs/<?php echo $curs['id_curs']; ?>"><?php echo $curs['titlu']; ?></a>
					</h3>
					<p><strong>Profesor:</strong> <?php echo $curs['nume']; ?></p>
					<p>Start curs: <?php echo date('d-m-Y', strtotime($curs['data_inceput'])); ?></p>
					<?php if(are_rol('administrator') || are_rol('profesor')) { ?>
					<p>
						<?php if(are_rol('administrator')) { ?>
						<a href="<?php echo URL; ?>index.php?url=cursuri/adauga_utilizatori_curs/<?php echo $curs['id_curs']; ?>" class="btn">Adauga cursanti</a> 
						<?php } ?>
						
						<?php if(are_rol('administrator') || are_rol('profesor')) { ?>
						<a href="<?php echo URL; ?>index.php?url=cursuri/adauga_eveniment/<?php echo $curs['id_curs']; ?>" class="btn">Adauga eveniment</a> 
						<?php } ?>
						
						<?php if(are_rol('administrator')) { ?>
						&nbsp; <a href="<?php echo URL; ?>index.php?url=cursuri/sterge_curs/<?php echo $curs['id_curs']; ?>" class="btn"><i class="icon icon-remove"></i></a>
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