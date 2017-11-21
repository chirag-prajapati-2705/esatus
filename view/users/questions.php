<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">Vos questions</h1>
  </div>
</div>



<?php if ($questions): ?>
<div class="container"> 
    <div class="row">
        <div class="span12">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Questions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($questions as $k=>$v): ?>
                  <tr>
                    <td class="white"><?= $v->question; ?></td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

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