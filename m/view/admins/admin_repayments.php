<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Virements
      <small>Liste des virements</small>
    </h1>

  </div>
</div>
<?php if ($repayments): ?>
<div class="container"> 
  <div class="row">
    <div class="span12">
      <h2>Virements (<?= $count; ?>)</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Service</th>
            <th>Date</th>
            <th>Montant</th>
            <th>Statut</th>
            <th>RIB</th>
            <th>Action</th>
            <th>Facture</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($repayments as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><?= $v->service; ?></td>
            <td class="white"><?= $v->date; ?></td>
            <td class="white"><?= $v->amount; ?> € <small>TTC</small></td>
            <td class="white"><span class="label label-<?= ($v->status == 0) ? 'warning':'success'; ?>"><?= ($v->status == 0) ? 'En attente':'Payé'; ?></span></td>
            <td class="white">
              <a href="<?= Router::url('admin/admins/bdi/id:'.$v->rib->id); ?>" class="btn btn-info" target="_blank"><small>Voir le rib</small></a>
            </td>
            <td class="white">
              <a href="<?= Router::url('admin/admins/transfer/id:'.$v->id); ?>" class="btn btn-info"><small>Virement effectué</small></a>
            </td>
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
</div>
<?php endif; ?>