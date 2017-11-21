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
            <th>Identité</th>
            <th>E-mail</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($profiles as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><a href="mailto:<?= $v->email; ?>"><?= $v->id; ?></a></td>
            <td class="white"><a href="mailto:<?= $v->email; ?>"><?= $v->email; ?></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>