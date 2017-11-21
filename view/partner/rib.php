<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">
            RIB
        </h1>
    </div>
</div>
<div class="container">
    <div class="row row-form">
        <div class="login-form span4 offset4">
            <form action="" method="post">
                <div class="control-group">
                    <label class="text" for="numero">Nom de la banque :</label>
                    <input type="text" class="login-field" placeholder="Soci&eacute;t&eacute; g&eacute;n&eacute;rale" name="banque" id="banque" value="<?= $rib->banque; ?>">

                </div>
                <div class="control-group">
                    <label class="text" for="iban">IBAN :</label>
                    <input type="text" class="login-field" placeholder="FR00 0000 0000 0000 0000 0000 000" name="iban" id="iban" value="<?= $rib->iban ?>">
                </div>
                <div class="control-group">
                    <label class="text" for="rib">BIC :</label>
                    <input type="text" class="login-field" placeholder="FR00 0000 0000 0000 0000 0000 000" name="bic" id="bic" value="<?= $rib->bic ?>">
                </div>
                <div class="control-group">
                    <label class="text" for="">Date de pr&Eacute;l&egrave;vement souhait&eacute; :</label>
                    <select class="login-field" name="prelevement"> 
                        <select style="width: 80px;" name="jj">
                            <option value="">Jour</option>
                            <?php for ($j = 1; $j <= 31; $j++): ?>
                                <option value="<?php echo $j ?>"><?php echo $j ?></option>
                            <?php endfor; ?>
                        </select>
                    </select> 
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
            </form>
        </div>
    </div>
</div>