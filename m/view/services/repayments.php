<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo"><img class="rounded" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>"><br>Vos Gains<br><small>Retrouvez ici l'historique de vos gains par mois</small></h1>
	</div>
</div>
<div class="container">
	<?= $this->Session->flash(); ?>
	<div class="row">
		<div class="span12 text-center">
			<p class="lead">
				Votre solde : <?= $balance->gain; ?> € &nbsp;&nbsp;&nbsp;
				<?php if ($balance->gain >= 150): ?>
				<a href="<?= Router::url('repayments/request/id:'.$id); ?>" class="btn btn-primary btn-large">Réclamer vos gains</a>
				<?php else: ?>
				<p>Vos gains sont insuffisants pour être réclamés (minimum 150 €).</p>
				<?php endif; ?>
			</p>
		</div>
	</div>
	<br/>
	<br/>
	<div class="row">
		<div class="span12">
			<h3>Mes gains par mois</h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Mois</th>
	                  	<th>Nombres d'appels</th>
	                  	<th>Gain brut</th>
	                  	<th>Gain net</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($years as $year=>$months): ?>
					<?php foreach ($months as $month=>$stats): ?>
					<tr>
						<td class="white"><?= $stats->date; ?></td>
						<td class="white"><?= $stats->count; ?></td>
						<td class="white"><?= $stats->benefit; ?></td>
						<td class="white"><?= $stats->reel; ?></td>
					</tr>
					<?php endforeach; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php if ($repayments): ?>
	<div class="row">
		<div class="span12">
			<h3>Mes reversements</h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Date</th>
	                  	<th>Montant</th>
	                  	<th>Statut</th>
	                  	<th>Facture</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($repayments as $k=>$v): ?><?php $v = current($v); ?>
					<tr>
						<td class="white"><?= $v->date; ?></td>
						<td class="white"><?= $v->amount; ?> €</td>
						<td class="white"><span class="label label-<?= ($v->status == 0) ? 'warning':'success'; ?>"><?= ($v->status == 0) ? 'En attente':'Effectué'; ?><span></td>
						<td class="white">
							<a href="<?= Router::url('pdf/bills/repayment/id:'.$v->id); ?>" target="_blank">
								<img src="<?= IMAGE; ?>icones/pdf.png" alt="voir la facture">
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php endif; ?>
</div>