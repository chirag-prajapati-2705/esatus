<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Clients
      <small>Liste des clients</small>
    </h1>

  </div>
</div>
 
<div class="container"> 
    <div class="row">
    <div class="span12">
      <h2>Clients (<?= $count; ?>)</h2>
      <a href="<?= Router::url('partner/adduser'); ?>">Ajouter clients</a>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Identité</th>
            <th>E-mail</th>
            <th>Date</th>
            <th>Appels émis</th>
            <th>Dépensé</th>
            <th>Paiement</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Profiles as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><?= $v->idProfile; ?></td>
            <td class="white" style="color:<?= $v->color; ?>;"><?= $v->slug; ?></td>
            <td class="white"><a href="mailto:<?= $v->email; ?>"><?= $v->email; ?></a></td>
            <td class="white"><?= $v->date_inscription; ?></td>
            <td class="white"><?= $v->count; ?></td>
            <td class="white"><?= $v->amount; ?></td>
            <td class="white">
                <a href="<?= Router::url('partner/cbb/'. $v->id); ?>"><button type="button" class="btn btn-primary btn-xs">CCB</button></a>
                <a href="<?= Router::url('partner/rib/'. $v->id); ?>"><button type="button" class="btn btn-primary btn-xs">RIB</button></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>