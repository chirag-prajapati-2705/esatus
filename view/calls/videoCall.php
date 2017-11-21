<div id="temps" onload="javascript:lancerCompteur(0);"></div>
<div class="container">
    <div class="pane" id="pane_0">
        <center>Chargement en cours.</center>
        <center><img src="<?= IMAGE; ?>attente.gif" alt="attente"></center>
    </div>
    <div class="pane" id="pane_1" style="display: none">
        <p><br><br><center>Pour démarrer l'appel vidéo , cliquez sur « Lancer l'appel ».</center></p>
        <center><input type="button" value="Lancer l'appel" id="call" class="btn btn-info btn-default"></center>
    </div>
    <div class="pane" id="pane_2" style="display: none">
        <div id="video_container"></div>
        <center><input type="button" value="Arrêter l'appel" id="quit" class="btn btn-danger btn-default"></center>
    </div>
</div>


