<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">
            CBB
        </h1>
    </div>
</div>
<div class="container">
    <div class="row row-form">
        <div class="login-form span4 offset4">
            <form action="" method="post">
                <div class="control-group">
                    <label class="text" for="numero">Numéro de carte :</label>
                    <input type="text" class="login-field" placeholder="1111222233334444" name="numero" id="numero" value="<?= $card->mark; ?>">
                    <?php if ($card->mark != '0000'): ?>
                        <div class="alert alert-info">Pour votre sécurité ce champ est scyndé en deux parties et crypté.</div>
                    <?php endif; ?>
                </div>
                <div class="control-group">
                    <label>Date de fin de validité :</label>
                    <select class="login-field" name="month"> 
                        <option value="">Mois</option>
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                            <option value="<?php echo $m ?>"><?php echo $m ?></option>
                        <?php endfor; ?>
                    </select> 
                    
                    <select class="login-field" name="year" style="margin-top: 10px;" > 
                        <option value="">Année</option>
                           <?php for ($a = 2016; $a <= 2021; $a++): ?>
                                <option value="<?php echo $a ?>"><?php echo $a ?></option>
                            <?php endfor; ?>
                    </select>
                </div>
                <div>
                    <label class="text" for="crypto">Cryptogramme visuel :</label>
                    <input type="text" class="login-field" placeholder="123" name="crypto" id="crypto" value="<?= $card->cryptogram; ?>">
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
            </form>
        </div>
    </div>
</div>