
	<div class="row">
	
		<div class="span8">
		
			<p><a href="<?php echo URL . 'index.php?url=mesaje'; ?>" class="btn">Inapoi la mesaje</a></p>
		
			<h4>De la: <?php echo $detalii_mesaj['nume']; ?></h4>
			
			<p><small>transmis la data: <?php echo $detalii_mesaj['data_creare']; ?></small></p>
		
			<p><?php echo $detalii_mesaj['mesaj']; ?></p>
		
		</div>
		
	</div>