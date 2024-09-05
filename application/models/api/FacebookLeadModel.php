<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';

use Facebook\Facebook;

// use vendor\Facebook;

class FacebookLeadModel extends CI_Model
{
    private $fb;
    private $accessToken;

    public function __construct()
    {
        parent::__construct();

        // Initialize Facebook SDK
        $this->fb = new Facebook([
            'app_id' => '471551299087976',
            'app_secret' => '163bc698570e0e6c9b58a3c5ffb11751',
            'default_graph_version' => 'v12.0',
        ]);

        // $this->accessToken = '471551299087976|5RXBhc5sUhVO913wJijY7hYT-Gg';
        $this->accessToken = 'EAAGs35es7mgBOzNY3oEwDc794UiLD8hDASaErGqKTY7xkpz1uZCZBlLKOvxiJ9n9PsYjaIBHlLTLqzdnk9ZADHo8XY9nlRiCUt0ZCp90kuJO0nlVoYBCuK12MGm4fVnf6dxYXSkk3XtpwBL7jrkiy08K3BuvYlLZAuDH00twrp3rX30R4a6InC9ycY40y718UBnix7aWjM1NGNNm43AZDZD';
    }

    public function getLeads($formId)
    {
        try {
            $response = $this->fb->get("/$formId/leads", $this->accessToken);
            return $response->getDecodedBody();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            log_message('error', 'Graph returned an error: ' . $e->getMessage());
            return false;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            log_message('error', 'Facebook SDK returned an error: ' . $e->getMessage());
            return false;
        }
    }
}
