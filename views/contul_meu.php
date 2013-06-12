
	<div class="row">
	
		<div class="span3">
		
			<p>
			<a href="#" class="thumbnail">
                  <img style="width: 160px; height: 160px;" src="<?php echo URL.'media/img/avatar-blank.jpg'; ?>">
			</a>
			</p>
			
			<p>Inscris la x cursuri</p>
			<p>Membru al universitatii virtuale din <?php echo date('d-m-Y', strtotime($utilizator['data_creare'])); ?></p>
		
		</div>
		
		<div class="span5">
		
			<h2><?php echo $utilizator['nume']; ?> <small>(<?php echo $utilizator['nume_rol']; ?>)</small></h2>
			
			<p>Telefon: <?php echo $utilizator['telefon'] != "" ? $utilizator['telefon'] : '-'; ?></p>
			<p>Adresa: <?php echo $utilizator['adresa'] != "" ? $utilizator['adresa'] : '-'; ?></p>
			<p>Localitate: <?php echo $utilizator['localitate'] != "" ? $utilizator['localitate'] : '-'; ?></p>
			<p>Ultima activitate: <?php echo date('H:i d-m-Y', strtotime($utilizator['ultima_activitate'])); ?></p>
			
			<p><a href="<?php echo URL.'index.php?url=utilizator/actualizare_cont'; ?>" class="btn btn-primary">Actualizeaza informatii</a> &nbsp; <a href="<?php echo URL.'index.php?url=utilizator/schimba_parola'; ?>" class="btn">Schimba parola</a></p>
		
		</div>
	
	</div>