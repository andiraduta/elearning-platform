
	<div class="row">
	
		<div class="span8">
		
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
		
			<h2><?php echo $detalii_curs['titlu']; ?></h2>
			
			<div class="well">
				<h4>Forum discutii</h4>
				<?php if(are_rol('profesor') || are_rol('administrator')) { ?>
				<p><a href="<?php echo URL.'index.php?url=cursuri/adauga_subiect_discutie/'.$id_curs.'_'.$detalii_curs['id_forum']; ?>" class="btn">Adauga subiect de discutie</a></p>
				<?php } ?>
				<?php
				if( !empty($discutii) ) {
					foreach( $discutii as $discutie ) {
						echo '<p>';
						echo '<a href="'.URL.'index.php?url=cursuri/postari/'.$id_curs.'_'.$discutie['id_discutie'].'">'.$discutie['titlu'].'</a> ('.$discutie['nr_postari'].' '.($discutie['nr_postari'] == 1 ? 'postare' : 'postari').') ';
						if( are_rol('administrator') || are_rol('profesor') ) {
							echo '<a href="'.URL.'index.php?url=cursuri/modifica_subiect_discutie/'.$id_curs.'_'.$discutie['id_discutie'].'"><i class="icon icon-edit"></i></a> ';
							echo '<a href="'.URL.'index.php?url=cursuri/sterge_subiect_discutie/'.$id_curs.'_'.$discutie['id_discutie'].'"><i class="icon icon-remove"></i></a>';
						}
						echo '</p>';
					}
				} else {
				?>
				<p>Nu exista subiecte de discutie in acest moment.</p>
				<?php } ?>
			</div>
			
			<h3>Activitati curs</h3>
			<?php if(are_rol('profesor') || are_rol('administrator')) { ?>
			<p><a href="<?php echo URL; ?>index.php?url=cursuri/adauga_activitate_curs/<?php echo $id_curs; ?>" class="btn">Adauga activitate</a> </p>
			<?php } ?>
			<?php
			if( !empty($activitati) ) {
			foreach( $activitati as $activitate ) {
				$link_editare = "";
				if( are_rol('profesor') || are_rol('administrator') ) {
					if($activitate['tip_activitate'] != 'fisier') {
						$link_editare .= '<a href="'.URL.'index.php?url=cursuri/modifica_activitate_'.$activitate['tip_activitate'].'/'.$id_curs.'_'.$activitate['id_activitate'].'"><i class="icon icon-edit"></i></a>';
					}
					$link_editare .= '<a href="'.URL.'index.php?url=cursuri/sterge_activitate_'.$activitate['tip_activitate'].'/'.$id_curs.'_'.$activitate['id_activitate'].'"><i class="icon icon-remove"></i></a>';
				}
				switch($activitate['tip_activitate']) {
					case "url":
						?>
						<h4><?php echo $activitate['titlu_activitate_url'],' ',$link_editare; ?></h4>
						<div class="well">
							<p>Legatura externa: <a href="<?php echo $activitate['link']; ?>" target="_blank"><?php echo $activitate['nume_url']; ?></a></p>
						</div>
						<?php
						break;
					case "fisier":
						?>
						<h4><?php echo $activitate['titlu_activitate_fisier'],' ',$link_editare; ?></h4>
						<div class="well">
							<p><?php echo $activitate['descriere']; ?></p>
							<p><a href="<?php echo URL.$activitate['fisier']; ?>" target="_blank">Vezi fisier</a></p>
						</div>
						<?php
						break;
					case "lectie":
						?>
						<h4><?php echo $activitate['titlu_activitate_lectie'],' ',$link_editare; ?></h4>
						<div class="well">
							<p><?php echo $activitate['continut']; ?></p>
						</div>
						<?php
						break;
				}
			}
			} else {
			?>
			<p>Nu exista activitati in acest moment.</p>
			<?php } ?>
		
		</div>
	
	</div>