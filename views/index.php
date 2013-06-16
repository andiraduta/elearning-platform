
			<div class="hero-unit">
				<h1>Bine aţi venit!</h1>
				<p>Portalul universitatii virtuale va permite sa accesati online cursurile, materialele, temele si sa comunicati mai usor cu profesorii.</p>
				<p>
					<?php if( !este_logat() ) { ?>
					<a href="<?php echo URL.'index.php?url=login'; ?>" class="btn btn-primary btn-large">Vezi lista de cursuri &raquo;</a>
					<?php } else { ?>
					<a href="<?php echo URL.'index.php?url=cursuri/cursurile_mele'; ?>" class="btn btn-primary btn-large">Vezi lista de cursuri &raquo;</a>
					<?php } ?>
				</p>
			</div>

			<div class="row">
				<div class="span8">
					<h3>Categorii cursuri</h3>
					<?php
					function afiseaza_categorii($categorii_cursuri) {
						$afiseaza = '';
						foreach($categorii_cursuri as $categorie) {
							$afiseaza .= '<li>';
							$afiseaza .= '<a href="'.URL.'index.php?url=cursuri/categorie/'.$categorie['id_categorie'].'">'.$categorie['titlu'].'</a>';
							if( !empty($categorie['subcategorii']) ) {
								$afiseaza .= '<ul class="subcategorie">';
								$afiseaza .= afiseaza_categorii($categorie['subcategorii']);
								$afiseaza .= '</ul>';
							}
							$afiseaza .= '</li>';
						}
						return $afiseaza;
					}
					?>
					<ul class="nav nav-pills nav-stacked">
						<?php
						if(!empty($categorii_cursuri)) {
							echo afiseaza_categorii($categorii_cursuri);
						}
						?>
						<!--
						<li>
							<a href="#">Facultatea de Matematica si Informatica</a>
							<ul>
								<li><a href="#">Departamentul de Matematica</a></li>
								<li><a href="#">Departamentul de Informatica</a></li>
								<li><a href="#">Departamentul de Tehnologii</a></li>
							</ul>
						</li>
						<li><a href="#">Facultatea de Geografie</a></li>
						<li><a href="#">Facultatea de Litere</a></li>
						-->
					</ul>
				</div>
			</div>