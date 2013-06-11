
	<div class="row">
	
		<div class="span8">
		
			<h2>Utilizatori</h2>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
			
			<p>
				<a class="btn btn-success" href="<?php echo URL.'index.php?url=utilizator/adauga'; ?>"><i class="icon-plus icon-white"></i> Adauga utilizator</a>
			</p>
						
			<br>
			
			<div class="row-fluid">
				
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Id</th>
							<th>Username</th>
							<th>Rol</th>
							<th>Activ</th>
							<th width="250">Actiuni</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!empty($utilizatori)) {
							foreach($utilizatori as $utilizator) {
							?>
							<tr>
								<td><?php echo $utilizator['id_utilizator']; ?></td>
								<td><?php echo $utilizator['username']; ?></td>
								<td><?php echo strtolower($utilizator['nume_rol']); ?></td>
								<td><?php echo $utilizator['activ'] == 1 ? 'activ' : 'inactiv'; ?></td>
								<td>
									<a class="btn btn-info" href="<?php echo URL.'index.php?url=utilizator/modifica/'.$utilizator['id_utilizator']; ?>"><i class="icon-pencil icon-white"></i> Modifica</a> 
									<a class="btn btn-danger" href="<?php echo URL.'index.php?url=utilizator/'.($utilizator['activ'] == 1 ? 'dezactiveaza' : 'activeaza').'/'.$utilizator['id_utilizator']; ?>"><i class="icon-trash icon-white"></i> <?php echo $utilizator['activ'] == 1 ? 'Dezactiveaza' : 'Activeaza'; ?></a>
								</td>
							</tr>
							<?php
							}
						} else {
						?>
						<tr>
							<td>Nu exista utilizatori.</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				
			</div>
		
		</div>
	
	</div>