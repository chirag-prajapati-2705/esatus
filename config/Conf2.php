<?php

    class Conf {

        /**
         * Configurer le titre de l'application.
         */
        static $title = '';

        /**
         * Configurer l'accès à la base de donnée.
         */
        static function database() {
            return array(
                // Prod
                'host' => 'localhost',
                'database' => 'esatus',
                'login' => 'esatus_bdd_user',
                'password' => 'zFan08*6-xyz1258@'
            );
        }
        
    }
        
    // Définition des préfixes
    Router::prefix('admin','admin');
    Router::prefix('pdf','pdf');
    Router::prefix('server','server');
    Router::prefix('ajax','ajax');
    Router::prefix('xml','xml');
    Router::prefix('txt','txt');
    Router::prefix('csv','csv');




    // -------------------------------------------------------------------------------------------
    // Page Statique
    // -------------------------------------------------------------------------------------------

    Router::connect('','pages/index');
    Router::connect('foire-aux-questions-client','pages/customersfaq');
    Router::connect('foire-aux-questions-expert','pages/expertsfaq');
    Router::connect('contactez-nous','pages/contact');
    Router::connect('consultationgratuite','pages/consultation-gratuite');
    Router::connect('conditions-générales-d-utilisation','pages/termsofuse');
    Router::connect('mentions-legales','pages/imprint');



    // -------------------------------------------------------------------------------------------
    // Administration
    // -------------------------------------------------------------------------------------------

    // Connexion / Déconnexion
    Router::connect('administration/connexion','admins/login');
    Router::connect('administration/deconnexion','admins/logout');  

    // Dashboard 
    Router::connect('administration','admin/admins/index');

    // Clients
    Router::connect('administration/clients','admin/admins/users');
    Router::connect('administration/clients/:slug-:id','admin/admins/user/slug:([a-z0-9_\-]+)/id:([0-9]+)');

    // Ribs
    // added by andru
    Router::connect('administration/ribs','admin/admins/ribs');
    Router::connect('administration/ribs/statut/:id','admin/admins/rswitch/id:([0-9]+)');

    // Experts
    Router::connect('administration/experts','admin/admins/services');
    Router::connect('administration/experts/statut/:id','admin/admins/toggle/id:([0-9]+)');
    Router::connect('administration/experts/:slug-:id','admin/admins/service/slug:([a-z0-9_\-]+)/id:([0-9]+)');

    // Virements
    Router::connect('administration/virements','admin/admins/repayments');
    Router::connect('administration/virements/rib/:id','admin/admins/bdi/id:([0-9]+)');
    Router::connect('administration/virements/effectue/:id','admin/admins/transfer/id:([0-9]+)');

    // Appels
    Router::connect('administration/appels','admin/admins/calls');
    Router::connect('administration/appels/month/:year/:month','admin/admins/callsmonths/year:([0-9]+)/month:([0-9]+)');
    Router::connect('administration/appels/reglement/:id','admin/admins/switch/id:([0-9]+)');
    Router::connect('administration/appels/reglementappel/:id-:year-:month','admin/admins/switchcallmonth/id:([0-9]+)/year:([0-9]+)/month:([0-9]+)');
    // added by andru
    Router::connect('administration/appels_rib','admin/admins/calls_rib');
    Router::connect('administration/appels/rcreglement/:id','admin/admins/rcswitch/id:([0-9]+)');
    
    // Impayés
    Router::connect('administration/impayés','admin/admins/unpaids');
    Router::connect('administration/impayés/reglement/:id','admin/admins/regulation/id:([0-9]+)');
    Router::connect('administration/impayés/:id','admin/admins/repay/id:([0-9]+)');
    
    // Catégories
    Router::connect('administration/categories','admin/admins/categories');
    Router::connect('administration/categories/ajouter/:id','admin/admins/add/id:([0-9]+)');
    Router::connect('administration/categories/modifier/:id','admin/admins/edit/id:([0-9]+)');
    
    // Inscris
    Router::connect('administration/inscris','admin/admins/inscris');
    
    // Promo
    Router::connect('administration/promo','admin/admins/promo');
    Router::connect('administration/promo/statut/:id','admin/admins/toggleCampagne/id:([0-9]+)');
    Router::connect('administration/promo/ajouter','admin/admins/addPromo/');
    Router::connect('administration/affect/:id','admin/admins/affect/id:([0-9]+)');
    Router::connect('administration/affectcategorie/:id','admin/admins/affectcategorie/id:([0-9]+)');
    Router::connect('administration/affecter/:id1/:id','admin/admins/toggleAffecter/id1:([0-9]+)/id:([0-9]+)');
    Router::connect('administration/DeleteAll/:id','admin/admins/toggleDeleteAll/id:([0-9]+)');
    Router::connect('administration/affecter/:id2','admin/admins/toggleAddAll/id2:([0-9]+)');
    Router::connect('administration/editPromo/:id','admin/admins/admin_editPromo/id:([0-9]+)');

    // -------------------------------------------------------------------------------------------
    // Espace Client / Expert
    // -------------------------------------------------------------------------------------------

    // Création / Suppression de compte
    Router::connect('creer-un-compte','profiles/signin');
    Router::connect('creer-un-compte-expert','profiles/signinExpert');
    Router::connect('valider/:id','profiles/confirmation/id:([0-9]+)');
    Router::connect('supprimer-mon-compte','profiles/signout');
    

    Router::connect('creer-un-compte-2','profiles2/signin2');
    Router::connect('creer-un-compte-2/:email/:nom/:prenom','profiles2/signin2/email:([a-zA-Z0-9.@_\-]+)/nom:([a-zA-Z0-9_\-]+)/prenom:([a-zA-Z0-9_\-]+)');
    
    Router::connect('creer-un-compte/mes-informations','users/create');
    //added by andru
    Router::connect('creer-un-compte/ma-rib','users/verify_rib');
    Router::connect('creer-un-compte/ma-carte','users/verify');
    Router::connect('check/:cv/:email/:nom/:prenom/:naissance','users/check/cv:([a-zA-Z0-9_\-]+)/email:([a-zA-Z0-9.@_\-]+)/nom:([a-zA-Z0-9_\-]+)/prenom:([a-zA-Z0-9_\-]+)/naissance:([a-zA-Z0-9_\-]+)');
    

    // Connexion / Déconnexion
    Router::connect('connexion','profiles/login');
    Router::connect('deconnexion','profiles/logout');
    

    // Mot de passe oublié
    Router::connect('mot-de-passe-oublie','profiles/password');
    Router::connect('changement-de-mot-de-passe/:id','profiles/reset/id:([a-z0-9_\-]+)');

    // Espace client
    Router::connect('espace-client','users/index');
    Router::connect('espace-client/mes-informations','users/datas');
    Router::connect('espace-client/mes-questions','users/questions');
    Router::connect('espace-client/mes-appels','users/calls');
    // added by andru
    Router::connect('espace-client/ma-rib','users/rib');
    Router::connect('espace-client/ma-carte-bancaire','users/card');
    Router::connect('parainage','users/index');


    // Espace expert
    Router::connect('espace-expert','services/index');
    Router::connect('espace-expert/creer-un-service','services/create');
    Router::connect('espace-expert/mon-service/:id','services/service/id:([0-9]+)');
    Router::connect('espace-expert/mes-informations/:id','services/edit/id:([0-9]+)');
    Router::connect('espace-expert/mes-disponibilies/:id','services/availabilities/id:([0-9]+)');
    Router::connect('espace-expert/mes-appels/:id','services/calls/id:([0-9]+)');
    Router::connect('espace-expert/mes-appels/commentaires/:id/:cid','services/comments/id:([0-9]+)/cid:([0-9]+)');
    Router::connect('espace-expert/mes-appels/commentaires/supprimer/:id/:sid/:cid','comments/erase/id:([0-9]+)/sid:([0-9]+)/cid:([0-9]+)');
    Router::connect('espace-expert/mes-gains/:id','services/repayments/id:([0-9]+)');
    Router::connect('espace-expert/mes-gains/virement/:id','repayments/request/id:([0-9]+)');
    Router::connect('espace-expert/mon-rib/:id','services/bdi/id:([0-9]+)');

    // Facture
    Router::connect('espace-expert/mes-gains/facture/:id','pdf/bills/repayment/id:([0-9]+)');




    // -------------------------------------------------------------------------------------------
    // Rechercher un expert
    // -------------------------------------------------------------------------------------------

    // Formulaire
    Router::connect('rechercher','pages/search');
    
    // Recherche experts
    Router::connect('experts','categories/index');
    Router::connect('experts/:slug','categories/category/slug:([a-z0-9_\-]+)');
    Router::connect('experts/:cat/:subcat','categories/subcategory/cat:([a-z0-9_\-]+)/subcat:([a-z0-9_\-]+)');
    Router::connect('experts/:cat/:subcat/:slug-:id','services/view/cat:([a-z0-9_\-]+)/subcat:([a-z0-9_\-]+)/slug:([a-z0-9_\-]+)/id:([0-9]+)');

    // Recherche experts landing
    Router::connect('landing','categories/index');
    Router::connect('landing/:slug','categories/categorylanding/slug:([a-z0-9_\-]+)');
    Router::connect('landing/:cat/:subcat','categories/subcategorylanding/cat:([a-z0-9_\-]+)/subcat:([a-z0-9_\-]+)');
    Router::connect('landing/:cat/:subcat/:slug-:id','services/view/cat:([a-z0-9_\-]+)/subcat:([a-z0-9_\-]+)/slug:([a-z0-9_\-]+)/id:([0-9]+)');

    // Appeler experts
    Router::connect('appeler/:slug-:id','calls/call/slug:([a-z0-9_\-]+)/id:([0-9]+)');
    Router::connect('appeler2/:oldsession','calls/check_launch/slug:([a-z0-9_\-]+)');
    //added by andru
    Router::connect('vappeler/:slug-:id','calls/videocall/slug:([a-z0-9_\-]+)/id:([0-9]+)');
    Router::connect('appelvideo/:slug-:id','calls/videoCall/slug:([a-z0-9_\-]+)/id:([0-9]+)');
    Router::connect('orange/reponse','server/calls/response');

    // Noter experts
    Router::connect('noter/:id','ratings/rate/id:([a-z0-9_\-]+)');




    // -------------------------------------------------------------------------------------------
    // Ajax
    // -------------------------------------------------------------------------------------------

    // Obtenir les sous catégories d'une categorie
    Router::connect('sous-categorie/liste','ajax/subcategories/getList');

    // Obtenir la plage horaire suivante
    Router::connect('disponibilites/suivante','ajax/availabilities/next');
    Router::connect('disponibilites/sauvagarder/:id','ajax/availabilities/save/id:([0-9]+)');
    Router::connect('disponibilites/vider','ajax/availabilities/empty');






    // -------------------------------------------------------------------------------------------
    // Moteurs de recherche
    // -------------------------------------------------------------------------------------------

    // Gestion des fichiers .xml
    Router::connect('sitemap.xml','xml/pages/sitemap');

    // Gestion des fichiers .txt
    Router::connect('robots.txt','txt/pages/robots');
    Router::connect('humans.txt','txt/pages/humans');
    
    // Gestion des fichiers .csv
    Router::connect('csv/export/users','csv/export/users');
?>