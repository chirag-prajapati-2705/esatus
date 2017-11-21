<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">
            Campagne de promotion
            <small>Campagne de promotion</small>
        </h1>

    </div>
</div>

<div class="container"> 
    <div class="row">
        <div class="span12">
            <form id="form" action="<?= Router::url('admin/admins/affectcategorie/2'); ?>" method="post">
          <br>
      <small><input type="submit" value="Enregistrer" class="btn btn-primary btn-large btn-block"></small>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Promo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $k => $v): ?><?php $v = current($v); ?> 
                        <tr>
                            <td class="white"><?= $v->title; ?></td>
                            <td class="white">
                                <select name="<?= $v->id; ?>">
                                    <option value="0" <?php if ($v->id_campagne == '0'): ?> selected="selected" <?php endif; ?>>Choisir une campagne</option>
                                    <?php foreach ($Campagne as $campagne): ?>
                                    <option value="<?php echo $campagne->Campagne->id ?>" <?php if ($v->id_campagne == $campagne->Campagne->id): ?> selected="selected" <?php endif; ?>><?php echo $campagne->Campagne->libelle ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
 </form>
        </div>
    </div>
</div>
