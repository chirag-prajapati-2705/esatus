<div class="container masterhead">
	<div class="demo-headline">

	</div>
</div>
<?php //if ($calls): ?>
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
					<?php //foreach ($calls as $k=>$v): ?><?php $v = current($v); ?>
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
					<?php //endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php //endif; ?>
<style type="text/css">
.center {
  margin: 0 auto;
  max-width: 300px;
  width: 100%;
  float: none;
}

.container {
	width: 1000px;
}

.row {
	margin-left: 0px;
}
</style>