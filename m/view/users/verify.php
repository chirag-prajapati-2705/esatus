

<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">Ma carte bleue<br></h1>
    </div>
    <small>Sécurisé par &nbsp;<img style="vertical-align:middle;" src="<?= IMAGE ?>icones/paybox-100.jpg" alt="Paybox" /> et <img style="vertical-align:middle;" src="<?= IMAGE ?>icones/Credit-Agricole-32.jpg" alt="Credit Agricole" /></small><br><br>
</div>

<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="row row-form">
        <div class="login-form span4">
            <form action="<?= Router::url('users/verify'); ?>" method="post">
                <div class="control-group">
                    <label class="text" for="numero">Numéro de carte :</label>
                    <input type="text" class="login-field" placeholder="1111222233334444" name="numero" id="numero">
                </div>
                <div class="control-group">
                    <label class="text" for="">Date de fin de validité :</label>
                    <select class="login-field" name="month"> 
                        <?php foreach ($months as $key => $value): ?>
                            <option value="<?= $key; ?>"><?= $key; ?></option> 
                        <?php endforeach; ?>
                    </select> 
                    <select class="login-field" name="year"> 
                        <?php foreach ($years as $year): ?>
                            <option value="<?= $year; ?>"><?= $year; ?></option> 
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label class="text" for="crypto">Cryptogramme visuel :</label>
                    <input type="text" class="login-field" placeholder="123" name="crypto" id="crypto">
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
            </form>
            <a class="login-link" href="<?= Router::url('pages/contact'); ?>">Pas de carte bleue ?</a>
        </div>
        <spsn class="span7">
            <p style="color: #FF9D01;">10 Minutes offertes sur votre première consultation.</p>
            <p style="color: #FF9D01;">Un débit sera uniquement réalisé en cas de depassement des 10 minutes offertes.</p>
            <p>Offre valable uniquement sur votre premier appel.</p>
            <br>
            <p>Pour toutes questions appeler votre service client au 0982323527 numéro non surtaxé.</p>
            <br>
            <p>Votre numéro de carte bleu sera crypter et protéger par Paybox et Crédit Agricole.</p>
            <p>Les symboles indiquent que votre transaction est securisée, vous pouvez remplir votre formulaire en toute confiance <img style="vertical-align:middle;" src="<?= IMAGE ?>icones/paiement-securise.jpg" alt="" />. </p>
            <p>Aucune information bancaire n'est conservée dans nos propres serveur et site internet.</p>
            <small>Sécurisé par &nbsp;<img style="vertical-align:middle;" src="<?= IMAGE ?>icones/paybox-100.jpg" alt="Paybox" /> et <img style="vertical-align:middle;" src="<?= IMAGE ?>icones/Credit-Agricole-32.jpg" alt="Credit Agricole" /></small>
        </spsn>
        
    </div>
</div>