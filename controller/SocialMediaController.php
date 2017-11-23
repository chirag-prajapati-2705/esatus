<?php
require '../library/facebook/autoload.php';
include_once '../library/twitter/OAuth.php';
include_once '../library/twitter/twitteroauth.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

Class SocialMediaController extends Controller
{

    public $uses = array('Profile', 'User', 'Service');

    public function __construct()
    {
        parent::__construct();
        if ($this->Session->isLogged()) {
            $this->redirect('');
            die();
        }
    }


    public function index()
    {
        date_default_timezone_set("America/New_York");
        FacebookSession::setDefaultApplication('146961899265476', '540f51a7692f3526fbdaada6d51102a5');
        $helper = new FacebookRedirectLoginHelper('http://localhost/esatus_live_15_11/bin/index.php/facebook-login');
        try {
            $session = $helper->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            $this->Session->setFlash($ex->getMessage());
        } catch (Exception $ex) {
            $this->Session->setFlash($ex->getMessage());
        }

        // see if we have a session
        if (isset($session)) {
            $request = new FacebookRequest($session, 'GET', '/me?fields=name,email');
            $response = $request->execute();
            $graphObject = $response->getGraphObject();
            $facebook_id = $graphObject->getProperty('id');              // To Get Facebook ID
            $full_name = $graphObject->getProperty('name'); // To Get Facebook full name
            $email = $graphObject->getProperty('email');
            //$birthday= $graphObject->getProperty('birthday');
            $is_exists = $this->user_exist($email);
            if (!empty($is_exists)) {
                $this->Session->write('profile', current($profile));
                $this->redirect('');
                die();
            } else {
                $this->save_user($email, $full_name, $facebook_id, 'facebook');
                $this->Session->setFlash('Successfully registered in our site.');
                $this->redirect('');
            }

        } else {
            $loginUrl = $helper->getLoginUrl(array(
                "scope" => 'email',
            ));
            header("Location: " . $loginUrl);
        }
        die();
    }

    public function twitter_login()
    {

        date_default_timezone_set("America/New_York");
        if (isset($_GET['request'])) {
            try{
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
                $request_token = $connection->getRequestToken(OAUTH_CALLBACK);
                $_SESSION['token'] = $request_token['oauth_token'];
                $_SESSION['token_secret'] = $request_token['oauth_token_secret'];

                if ($connection->http_code == '200') {
                    $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
                    header('Location: ' . $twitter_url);
                } else {
                    $this->Session->setFlash('error, try again later!');
                    $this->redirect('');
                }
            }Catch(Exception $e){
                echo $e->getMessage();die;
            }
        }
        //Fresh authentication

        if (isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'], $_SESSION['token_secret']);
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if ($connection->http_code == '200') {
                $user_data = $connection->get('account/verify_credentials');
                $email = $user_data['email'];
                $twitter_id = $user_data['id_str'];
                $full_name = $user_data['name'];
                $is_exists = $this->user_exist($email);
                if (!empty($is_exists)) {
                    $this->Session->write('profile', current($profile));
                    $this->redirect('');
                } else {
                    $this->save_user($email, $full_name, $twitter_id, 'twitter');
                    $this->Session->setFlash('Successfully registered in our site.');
                    $this->redirect('');
                }
            } else {
                $this->Session->setFlash('error, try again later!');
                $this->redirect('');
            }

        } else {
            $this->Session->setFlash('error, try again later!');
            $this->redirect('');
        }
        die();
    }

    public function user_exist($email)
    {
        // Verification of the existence of the profile in base (email must be unique)
        return $this->Profile->findOneBy(array('conditions' => array('email' => $email)));

    }

    public function save_user($email, $full_name, $social_media_id, $register_by)
    {
        //Save Data in profile table
        $std = new stdClass();
        $std->email = $email;
        $std->password = sha1('123456');;
        $std->validated = 0;
        $std->affiliation = 0;
        $this->Profile->save($std);

        //Save Data in user table
        $stdUser = new stdClass();
        $stdUser->profile_id = $this->Profile->id;
        $stdUser->first_name = $full_name;
        $stdUser->last_name = $full_name;
        $stdUser->phone = '123456';
        $stdUser->pseudo = $full_name;
        $stdUser->birth_date = '2017-22-25';
        $stdUser->date_inscription = date('Y-m-d H:i:s');
        $stdUser->social_media_id = $social_media_id;
        $stdUser->register_by = $register_by;
        $this->User->save($stdUser);
        $this->Session->write('profile', $std);
        $this->Session->write('user', $stdUser);
    }


}