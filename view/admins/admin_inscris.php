<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Inscriptions
      <small>Liste des inscriptions</small>
    </h1>

  </div>
</div>
 
<div class="container"> 
    <div class="row">
    <div class="span12">
      <h2>Inscriptions (<?= $count; ?>)</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>E-mail</th>
            <th>Date de naissance</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Preinscription as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><span style="color: <?= $v->color; ?>"><?= $v->nom; ?></span></td>
            <td class="white"><span style="color: <?= $v->color; ?>"><?= $v->prenom; ?></a></span></td>
            <td class="white"><a href="mailto:<?= $v->email; ?>" style="color: <?= $v->color; ?>"><?= $v->email; ?></a></td>
            <td class="white"><span style="color: <?= $v->color; ?>"><?= $v->date_naissance; ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>