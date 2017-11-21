<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">
            Tableau de bord
            <small>Synthèse de l'activité du site</small>
        </h1>

    </div>
</div>

<div class="container">
    <div class="row demo-tiles">
        <div class="span4">
            <div class="tile">
                <i style="font-size:3em;font-style:normal;color:#333;"><?= $years[date('Y')][date('n')]->count; ?></i>
                <h3 class="tile-title">Appels <?= month(date('n')) . ' ' . date('Y'); ?></h3>
            </div>
        </div>
        <div class="span4">
            <div class="tile">
                <i style="font-size:3em;font-style:normal;color:#333;"><?= $years[date('Y')][date('n')]->reel; ?></i>
                <h3 class="tile-title">CA <?= month(date('n')) . ' ' . date('Y'); ?></h3>
            </div>
        </div>
        <div class="span4">
            <div class="tile">
                <i style="font-size:3em;font-style:normal;color:#333;"><?= number_format($total[date('Y')], 2); ?> €</i>
                <h3 class="tile-title">CA Année <?= date('Y'); ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="container"> 
    <div class="row">
        <div class="span12">
            <h2>Récapitulatif par mois</h2>
            <table class="table table-bordered">
                <tbody>
                    <?php foreach ($years as $year => $months): ?>
                        <tr><td colspan="4"><?= $year ?></td></tr>
                        <tr>
                            <td class="blue">Mois</th>
                            <td class="blue">Appels</th>
                            <td class="blue">CA</th>
                            <td class="blue">Impayés</th>
                        </tr>
                    </thead>
                    <?php foreach ($months as $month => $stats): ?>
                        <tr>
                            <td class="white"><?= $stats->date; ?></td>
                            <td class="white"><a href=""><?= $stats->count; ?></a></td>
                            <td class="white"><?= $stats->reel; ?> <small>TTC</small></td>
                            <td class="white"><?= $stats->unpaids; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>