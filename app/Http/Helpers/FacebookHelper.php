<?php

namespace App\Http\Helpers;

use Facebook\Facebook;
use Facebook\Helpers\FacebookRedirectLoginHelper;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Config;

session_start();

class FacebookHelper
{
    private $helper;
    private $session;
    private $fb;
    
    public function __construct()
    {
        $this->fb = new Facebook([
                            'app_id' => Config::get('facebook.client_id'),
                            'app_secret' => Config::get('facebook.client_secret'),
                            'default_graph_version' => 'v2.2',
                            ]);

        $this->helper = $this->fb->getRedirectLoginHelper();
    }

    public function getUrlLogin()
    {
        return $this->helper->getLoginUrl(url('facebookAuthenticate'), ['public_profile','email', 'user_friends']);
    }

    public function getUrlConnect()
    {
        return $this->helper->getLoginUrl(url('facebookConnect'), ['public_profile','email', 'user_friends']);
    }

    public function generateSessionFromRedirect()
    {
        $this->session = null;

        try {
            $accessToken = $this->helper->getAccessToken();
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        
        if (isset($accessToken)) {
          // Logged in!
            $_SESSION['facebook_access_token'] = (string) $accessToken;
        }
    }

    public function getData()
    {
        $this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        
        try {
            $response = $this->fb->get('/me?fields=id,first_name,last_name,friends,email');
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        return $response;
    }
}
