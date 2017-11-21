<html>
<body>

<form action="https://ppps.paybox.com/PPPS.php" method="post" name="Tests PPPS en HTTPS">
Date (<?php echo date('dmY') ?>) <input name="DATEQ" value="<?php echo date('dmY') ?>" size="8" maxlength="8" type="text"><br>
Type de question <input name="TYPE" value="00056" size="5" maxlength="5" type="text"><br>
Numero de question <input name="NUMQUESTION" value="0000000001" size="10" maxlength="10"
type="text"><br>
Montant <input name="MONTANT" value="100" size="10" maxlength="10" type="text"><br>
Site <input name="SITE" value="1101352" size="7" maxlength="7" type="text"><br>
Rang <input name="RANG" value="001" size="2" maxlength="2" type="text"><br>
Reference commande <input name="REFERENCE" value="TEST" size="30" maxlength="30"
type="text"><br>
Reference profile<input name="REFABONNE" value="" size="30" maxlength="30"
type="text"><br>
<input name="VERSION" value="00104" type="hidden"><br>
<input name="CLE" value="luguwPBf" type="hidden"><br>
<input name="IDENTIFIANT" value="" type="hidden"><br>
<input name="DEVISE" value="978" type="hidden"><br>
PORTEUR : <input name="PORTEUR" value=""><br>
Date : <input name="DATEVAL" value=""><br>
CVV : <input name="CVV" value=""><br>
<input name="ACTIVITE" value="027" type="hidden"><br>
<input name="ARCHIVAGE" value="AXZ130968CT2" type="hidden"><br>
<input name="DIFFERE" value="000" type="hidden"><br>
<input name="NUMAPPEL" value="" type="hidden"><br>
<input name="NUMTRANS" value="" type="hidden"><br>
<input name="AUTORISATION" value="" type="hidden"><br>
<input name="PAYS" value="" type="hidden"><br>
<input type="submit">
</form>
</body>
</html>