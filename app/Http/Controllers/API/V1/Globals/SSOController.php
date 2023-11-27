<?php

namespace App\Http\Controllers\API\V1\Globals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utilities\SSOHelper;
use Illuminate\Support\Facades\Hash;

class SSOController extends Controller
{
    public function getSnonce(Request $req){
        if (request()->ajax()) {
            $clientTime = intval($req->clientTime);
            $action     = trim($req->action);
            $fingerPrint= trim($req->fingerPrint);

            if(!isset($clientTime)) return response()->json(['status'=>'notok','msg'=>'Client time not found']);
            if(!isset($action)) return response()->json(['status'=>'notok','msg'=>'Action not found']);
            if(!isset($fingerPrint)) return response()->json(['status'=>'notok','msg'=>'Fingerprint not found']);

            $clientInfo= SSOHelper::getClientInfo();
            $userAgent  = $clientInfo['userAgent'];
            $clientIp   = $clientInfo['ipAddress'];

            $serverTime = SSOHelper::getServerTime();
            $deltaTime  = abs($serverTime - $clientTime);
            $gsalt      = hash('sha256', implode( '_', array(env('GSALT', 'SSOMyITTS'), $deltaTime, $fingerPrint)));

            $snonce= md5(implode( '_', array($gsalt, $serverTime, $clientIp, $userAgent, $action )));

            return response()->json(['status'=>'ok','msg'=>'success','snonce'=>$snonce, 'deltaTime'=>$deltaTime, 'serverTime'=>$serverTime,'gsalt'=>$gsalt,'fingerPrint'=>$fingerPrint]);
        }
        dd('Forbidden');
    }

    public function getOtp(Request $req){
        if (request()->ajax()) {
            $clientTime = intval($req->clientTime);
            $serverTime = intval($req->serverTime);
            $deltaTime  = intval($req->deltaTime);
            $gsalt      = trim($req->gsalt);
            $action     = trim($req->action);
            $snonce     = trim($req->snonce);
            $cnonce     = trim($req->cnonce);
            $fingerPrint= trim($req->fingerPrint);

            $clientInfo= SSOHelper::getClientInfo();
            $userAgent  = $clientInfo['userAgent'];
            $clientIp   = $clientInfo['ipAddress'];

            if(!isset($clientTime)) return response()->json(['status'=>'notok','msg'=>'Client time not found']);
            if(!isset($serverTime)) return response()->json(['status'=>'notok','msg'=>'serverTime time not found']);
            if(!isset($deltaTime)) return response()->json(['status'=>'notok','msg'=>'deltaTime time not found']);
            if(!isset($gsalt)) return response()->json(['status'=>'notok','msg'=>'gsalt not found']);
            if(!isset($action)) return response()->json(['status'=>'notok','msg'=>'Action not found']);
            if(!isset($snonce)) return response()->json(['status'=>'notok','msg'=>'snonce not found']);
            if(!isset($cnonce)) return response()->json(['status'=>'notok','msg'=>'cnonce not found']);
            if(!isset($fingerPrint)) return response()->json(['status'=>'notok','msg'=>'Fingerprint not found']);

            // check gsalt
            $newGsalt= hash('sha256', implode( '_', array(env('GSALT', 'SSOMyITTS'), $deltaTime, $fingerPrint)));
            if($gsalt != $newGsalt) return response()->json(['status'=>'notok','msg'=>'bad gsalt founded', 'salt'=>$gsalt, 'gsalt'=>$newGsalt]);

            // check time
            $newServerTime = SSOHelper::getServerTime();
            $newDeltaTime  = abs($newServerTime - $clientTime);
            if($deltaTime != $newDeltaTime) return response()->json(['status'=>'notok','msg'=>'bad timestamp founded']);

            // checkSnonce
            $newSnonce= md5(implode( '_', array($gsalt, $serverTime, $clientIp, $userAgent, $action )));
            if($snonce != $newSnonce) return response()->json(['status'=>'notok','msg'=>'bad snonce founded']);

            // check cnonce
            $newCnonce = md5(implode('_', [$newGsalt, $clientTime, $newSnonce, $action]));
            if($cnonce != $newCnonce) return response()->json(['status'=>'notok','msg'=>'bad cnonce founded']);

            // calc otp
            $machineId = SSOHelper::getHardwareId();
            $otp= SSOHelper::calcOtp(implode('_', [$newGsalt, $newSnonce, $newCnonce, $deltaTime]),  implode('_', [$userAgent, $clientIp, $machineId]), 48);
            return response()->json(['status'=>'ok','msg'=>'success','deltaTime'=>$deltaTime, 'serverTime'=>$serverTime,'fingerPrint'=>$fingerPrint,'otp'=>$otp,'lock'=>env('GSALT', 'SSOMyITTS')]);
        }
    }
}
