<div class="container masterhead">
	<div class="demo-headline">
            <h1 class="demo-logo"><br><br>Vos clients<br><small>
		<?php if ($Affectation): ?>
		Retrouvez ici l'historique des appels effectués par vos clients
		<?php else: ?>
		Aucun appel pour le moment.
		<?php endif; ?>
		</small></h1>
	</div>
</div>
<?php if ($Affectation): ?>
<div class="container"> 
	<div class="row">
		<div class="span12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Client</th>
						
						<th>Consommation</th>
                                                <th>Vos gains</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($Affectation as $k=>$v): ?><?php $v = current($v); ?>
					<tr>
						<td class="white"><a href="<?= Router::url('services/comments/id:'.$service->id.'/cid:'.$v->user_id) ?>"><?= $v->customer; ?></a></td>
						<td class="white">
							0
						</td>
                                                <td class="white">
							0
						</td>
					</tr>
					<?php endforeach; ?>
                                        <tr>
						<td class="white">Total :</td>
						<td class="white">
							0
						</td>
                                                <td class="white">
							0
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>