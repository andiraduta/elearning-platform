
	<div class="row">
	
		<div class="span8">
		
			<h3>Roluri si permisiuni</h3>
				<p>
					<a href="<?php echo URL; ?>index.php?url=utilizator/adauga_rol" class="btn btn-success"><i class="icon-plus icon-white"></i> Adauga rol utilizator</a>
				</p>
				<br />
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nume rol</th>
							<th width="200">Actiuni</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if( !empty($roluri) ) {
							foreach( $roluri as $rol ) {
							?>
							<tr>
								<td><?php echo $rol['id_rol']; ?></td>
								<td><?php echo $rol['nume_rol']; ?></td>
								<td>
									<a href="<?php echo URL.'index.php?url=utilizator/modifica_permisiuni_rol/'.$rol['id_rol']; ?>" class="btn btn-info"><i class="icon-pencil icon-white"></i> Permisiuni</a> 
								</td>
							</tr>
							<?php
							}
						} else {
						?>
						<tr>
							<td colspan="3">Nu exista roluri.</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
		
		</div>
	
	</div>