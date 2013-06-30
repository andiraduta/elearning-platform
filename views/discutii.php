
	<div class="row">
	
		<div class="span8">
		
			<h2><a href="<?php echo URL; ?>index.php?url=cursuri/curs/<?php echo $id_curs; ?>"><?php echo $detalii_curs['titlu']; ?></a></h2>
			<h3>Subiect: <?php echo $subiect['titlu']; ?></h3>
			
			<p><a href="<?php echo URL; ?>index.php?url=cursuri/adauga_postare/<?php echo $id_curs,'_',$id_subiect; ?>" class="btn">adauga postare</a></p>
			
			<?php
			if(!empty($postari)) {
				foreach($postari as $postare) {
				?>
				<div class="well">
					<p><small>Postat de <a href="#"><?php echo $postare['nume']; ?></a> la data <?php echo $postare['data_creare']; ?></small></p>
					<p><?php echo $postare['mesaj']; ?></p>
				</div>
				<?php
				}
			} else {
			?>
			<p>Nu exista postari in acest subiect de dicutie.</p>
			<?php } ?>
		
		</div>
	
	</div>