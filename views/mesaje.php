
	<div class="row">
	
		<div class="span8">
		
			<h2>Mesaje &nbsp;&nbsp;&nbsp; <a class="btn btn-success" href="<?php echo URL.'index.php?url=mesaje/trimite_mesaj' ?>"><i class="icon-plus icon-white"></i> Mesaj nou</a></h2>
			
			<?php echo isset($mesaj) ? $mesaj : ''; ?>
		
			<h4>Mesaje primite</h4>
		
			<table class="table table-striped">
				<thead>
					<tr>
						<td><strong>Expeditor</strong></td>
						<td><strong>Subiect</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Actiuni</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php
					if( !empty($mesaje) ) {
						foreach( $mesaje as $mesaj ) {
						?>
						<tr>
							<td><?php echo $mesaj['nume']; ?></td>
							<td><?php echo $mesaj['subiect']; ?></td>
							<td><span class="label label-<?php echo $mesaj['status'] == 1 ? 'success' : 'important'; ?>"><?php echo $mesaj['status'] == 1 ? 'citit' : 'necitit'; ?></span></td>
							<td><a href="<?php echo URL . 'index.php?url=mesaje/citeste/'.$mesaj['id_mesaj']; ?>" class="btn btn-primary">Citeste</a> <a href="<?php echo URL . 'index.php?url=mesaje/sterge/'.$mesaj['id_mesaj']; ?>" class="btn btn-danger">Sterge</a></td>
						</tr>
						<?php
						}
					} else {
					?>
					<tr>
						<td colspan="4"><p>Nu exista mesaje.</p></td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			
			
			<h4>Mesaje trimise</h4>
		
			<table class="table table-striped">
				<thead>
					<tr>
						<td><strong>Subiect</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Destinatar</strong></td>
						<td><strong>Data</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php
					if( !empty($mesaje_trimise) ) {
						foreach( $mesaje_trimise as $mesaj ) {
						?>
						<tr>
							<td><?php echo $mesaj['subiect']; ?></td>
							<td><span class="label label-<?php echo $mesaj['status'] == 1 ? 'success' : 'important'; ?>"><?php echo $mesaj['status'] == 1 ? 'citit' : 'necitit'; ?></span></td>
							<td><?php echo $mesaj['nume']; ?></td>
							<td><?php echo date('d.m.Y', strtotime($mesaj['data_creare'])); ?></td>
						</tr>
						<?php
						}
					} else {
					?>
					<tr>
						<td colspan="4"><p>Nu exista mesaje.</p></td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		
		</div>
	
	</div>