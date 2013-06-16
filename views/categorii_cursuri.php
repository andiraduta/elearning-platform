
	<div class="row">
	
		<div class="span8">
		
			<h3>Categorii de cursuri</h3>
				<p>
					<a href="<?php echo URL; ?>index.php?url=cursuri/adauga_curs" class="btn btn-success"><i class="icon-plus icon-white"></i> Adauga curs</a> 
					<a href="<?php echo URL; ?>index.php?url=cursuri/adauga_categorie" class="btn btn-success"><i class="icon-plus icon-white"></i> Adauga categorie</a>
				</p>
				<br />
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Categorie</th>
							<th width="200">Actiuni</th>
						</tr>
					</thead>
					<tbody>
						<?php
						function afiseaza_categorii($categorii_cursuri, $nivel = 0) {
							$afiseaza = '';
							foreach($categorii_cursuri as $categorie) {
								$afiseaza .= '<tr>';
								$afiseaza .= '<td>'.($nivel > 0 ? str_repeat('-', $nivel*2).' ' : '') . $categorie['titlu'].'</td>';
								$afiseaza .= '<td><a href="'.URL.'index.php?url=cursuri/modifica_categorie/'.$categorie['id_categorie'].'" class="btn btn-info"><i class="icon-pencil icon-white"></i> Modifica</a></td>';
								$afiseaza .= '</tr>';
								if( !empty($categorie['subcategorii']) ) {
									if($nivel > 0) {
										$nivel++;
									} else {
										$nivel = 1;
									}
									$afiseaza .= afiseaza_categorii($categorie['subcategorii'], $nivel);
								}
							}
							return $afiseaza;
						}
						
						if( !empty($categorii_cursuri) ) {
							echo afiseaza_categorii($categorii_cursuri, 0);
						} else {
						?>
						<tr>
							<td colspan="3">Nu exista categorii de cursuri.</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
		
		</div>
	
	</div>