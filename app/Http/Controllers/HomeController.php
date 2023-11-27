<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\V1\Globals\SSOController;
use Illuminate\Http\Request;

use App\Utilities\SSOHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $serverInfo= SSOHelper::getServerInfo();
        $clientInfo= SSOHelper::getClientInfo();
        $mobile= SSOHelper::isMobile() ? '1' : '2';
        $mac= $clientInfo['macAddress'] ? $clientInfo['macAddress'] : '0000:0000:0000';
        $loginUrl= env('WIFILOGIN_URL');
        $param= array();
        $param[]= 'portalType=portal1';
        $param[]= 'gw_ip='.env('GW_IP', $serverInfo['gateway']);
        $param[]= 'ip='.$clientInfo['ipAddress'];
        // $param[]= 'ip=10.217.16.204';
        $param[]= 'mac='.$mac;
        $param[]= 'net=1';
        $param[]= 'rmac=0';
        $param[]= 'tabs=pwd-voucher-oneclick-account';
        $param[]= 'cf=plcy1.php';
        $param[]= 'mobile='.$mobile;
        $param[]= 'hq=0';
        $param[]= 'poup=0';
        $param[]= 'langSw=0';
        $param[]= 'url='.env('APP_URL');
        $loginUrl= $loginUrl.''.implode('&',$param);
        $user= Auth::user();
        $ret= array(
            'loginUrl'=>$loginUrl,
            'authtype'=> 'pwd',
            'usrName'=>$user->no,
            'pwd'=>$user->no,
            'portalType'=>'portal1',
            'gw_ip'=> env('GW_IP', $serverInfo['gateway']),
            'ip'=>$clientInfo['ipAddress'],
            // 'ip'=>'10.217.16.204',
            'mac'=>$mac,
            'net'=>'1',
            'rmac'=>'0',
            'tabs'=>'pwd-voucher-oneclick-account',
            'cf'=>'plcy1.php',
            'mobile'=>$mobile,
            'hq'=>'0',
            'poup'=>'0',
            'langSw'=>'0',
            'url'=>env('APP_URL'),
            'loginPostUrl'=> env('WIFIPOSTLOGIN_URL'),
            'user'=> $user
        );
        // dd($loginUrl);
        // return view('home', $ret);
        return view('dashboard', $ret);
    }
}
