<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo"><img class="rounded" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>"><br>Vos appels reçus<br><small>
		<?php if ($calls): ?>
		Retrouvez ici l'historique des appels reçus
		<?php else: ?>
		Aucun appel pour le moment.
		<?php endif; ?>
		</small></h1>
	</div>
</div>
<?php if ($calls): ?>
<div class="container"> 
	<div class="row">
		<div class="span12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Client</th>
						<th>Durée</th>
						<th>Date</th>
						<th>Note</th>
						<th>Gain brut</th>
						<th>Gain net</th>
						<th>Paiement</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($calls as $k=>$v): ?><?php $v = current($v); ?>
					<tr>
						<td class="white"><a href="<?= Router::url('services/comments/id:'.$service->id.'/cid:'.$v->user_id) ?>"><?= $v->customer; ?></a></td>
						<td class="white"><?= $v->duration; ?></td>
						<td class="white"><?= $v->date; ?></td>
						<td class="white"><?= $v->rating; ?></td>
						<td class="white"><?= $v->benefit; ?></td>
						<td class="white"><?= $v->reel; ?></td>
						<td class="white">
							<span class="label label-<?= ($v->payment == 1) ? 'success':'warning';?>"><?= ($v->payment == 1) ? 'validé':'invalidé';?></span>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>