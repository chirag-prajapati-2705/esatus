<h2>Recharger</h2>
<p>Vous allez être redirigé vers la plateforme de paiement Paybox...</p>
<div>
	<form action="https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi" method="post">
		<input type="hidden" name="PBX_SITE" value="<?= $site; ?>">
		<input type="hidden" name="PBX_RANG" value="<?= $rank; ?>">
		<input type="hidden" name="PBX_IDENTIFIANT" value="<?= $id; ?>">
		<input type="hidden" name="PBX_TOTAL" value="<?= $amount; ?>">
		<input type="hidden" name="PBX_TYPEPAIEMENT" value="<?= $payment; ?>">
		<input type="hidden" name="PBX_DEVISE" value="<?= $currency; ?>">
		<input type="hidden" name="PBX_REFABONNE" value="<?= $email; ?>">
		<input type="hidden" name="PBX_CMD" value="<?= $cmd; ?>">
		<input type="hidden" name="PBX_PORTEUR" value="<?= $email; ?>">
		<input type="hidden" name="PBX_RETOUR" value="<?= $return; ?>">
		<input type="hidden" name="PBX_EFFECTUE" value="<?= $perform; ?>">
      	<input type="hidden" name="PBX_REFUSE" value="<?= $refuse; ?>">
      	<input type="hidden" name="PBX_ANNULE" value="<?= $cancel; ?>">
		<input type="hidden" name="PBX_REPONDRE_A" value="<?= $server; ?>">
		<input type="hidden" name="PBX_HASH" value="<?= $hash; ?>">
		<input type="hidden" name="PBX_TIME" value="<?= $datetime; ?>">
		<input type="hidden" name="PBX_HMAC" value="<?= $hmac; ?>">
		<input type="submit" value="Envoyer">
	</form>
</div>