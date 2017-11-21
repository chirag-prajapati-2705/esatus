<script language="javascript" type="text/javascript">
// Requette AJAX
function makeRequest(url,id_niveau,id_ecrire){
var http_request = false;

if (window.XMLHttpRequest) { 

   http_request = new XMLHttpRequest();
   if (http_request.overrideMimeType) {
       http_request.overrideMimeType('text/xml');
                      }
   } else if (window.ActiveXObject) { 
   
   var names = [
            "Msxml2.XMLHTTP.6.0",
            "Msxml2.XMLHTTP.3.0",
            "Msxml2.XMLHTTP",
            "Microsoft.XMLHTTP"
        ];
        for(var i in names)
        {
            try{ http_request = new ActiveXObject(names[i]); }
            catch(e){}
        }
   /*
          try {
              http_request = new ActiveXObject("Msxml2.XMLHTTP");
              } catch (e) {
          try {
http_request = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
*/
}

if (!http_request) {
alert('Abandon :( Impossible de crer une instance XMLHTTP');
return false;
}
http_request.onreadystatechange = function() { traitementReponse(http_request,id_ecrire); } //affectation fonction appele qd on recevra la reponse
// lancement de la requete
http_request.open('POST', url, true);
//changer le type MIME de la requte pour envoyer des donnes avec la mthode POST , !!!! cette ligne doit etre absolument apres http_request.open('POST'....
http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
obj=document.getElementById(id_niveau);
data="val_sel="+obj.value;
http_request.send(data);

}

function traitementReponse(http_request,id_ecrire) {
var affich="";

if (http_request.readyState == 4 ) {
//var http_request.status="200";
if (http_request.status == 200 && http_request.status < 300) {
// cas avec reponse de PHP en mode texte:
//chargement des elements reus dans la liste
var affich_list=http_request.responseText;
obj = document.getElementById(id_ecrire);
obj.innerHTML = affich_list;
}
else {
//alert(": "+http_request.status);	
//alert('Un problme est survenu avec la requete. Veuillez re-executer votre requete s\'il vous plait');
}
}
}
</script>