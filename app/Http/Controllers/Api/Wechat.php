<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Input;
use Illuminate\Support\Facades\URL;
use App\Http\Services\Wechat as WechatS;
use App\Http\Models\User as UserM;


class Wechat extends Controller
{

    public $weObj;

    public function __construct($debug = false)
    {
        $options = array(
            'token'=>'weixin',
            'encodingaeskey'=>'cQ9gbUiSBRK2VuPnyMDi61i4oDXn29QTe4xpo1MTFhb',
            'appid'=>'wx2a0cd2e2bb3c55b4',
            'appsecret'=>'3b2928f2d55ecbe95a01dc3dc5d75b67'
        );
        $this->weObj = new WechatS($options);
    }

    public function serverAuth()
    {
        return $this->weObj->valid();
    }

    public function userAuth()
    {
        return $this->weObj->getOauthRedirect(Input::get('url'));
    }
    
    public function getUserInfo($access_token,$openid)
    {
        return $this->weObj->getOauthUserinfo($access_token,$openid);    
    }
    

    public function getAccessOrOpenid($code)
    {
        return $this->weObj->getOauthAccessToken($code);
    }
    
    public function jsOption()
    {
        $url = Input::get('url');
        return response()->json(['success' => 'Y', 'msg' => '', 'data' =>$this->weObj->getJsSign($url)]);
    }

    public function getMedia()
    {
        $this->weObj->getMedia('tx0nyTMSW2tGDo_dBdp6j_aH2ECm0Iu2GkAXWZyH068FiWXk6AQXnjdbCa9NbSa4');
    }

}