<?php

namespace App\Http\Middleware;

use App\Http\Controllers\cWeController;
use Closure;

/*

Note : 
C:\nginx\html\Project01\L01\app\Http\Kernel.php
harus tambahain

    protected $routeMiddleware = [
        'weToken' => \App\Http\Middleware\weToken::class,
    ];

*/
class weToken extends cWeController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->isMethod('get')) {
            $DataJSon = fnDecrypt($request->Data, "");
            if (is_null($DataJSon)) { 
                return response()->Json(fnProtectHack());
            }
        } else if ($request->isMethod('post')) {
            return $next($request);
            // Masalah post tidak bisa detect cookies
            // $DataJSon = fnDecrypt($request->params['Data'], "");
            // if (is_null($DataJSon)) { 
            //     return response()->Json(fnProtectHack());
            // }
        }

        $cookiesCode = \DB::connection()->getConfig("host").\DB::getDatabaseName().$DataJSon->AppName.$DataJSon->AppDateInfo;

        $cookiesTokenCode = fnEncryptPassword("token".$cookiesCode);
        $cookiesNameCode = fnEncryptPassword("name".$cookiesCode);
        $cookiesDateCode = fnEncryptPassword("dateInfo".$cookiesCode);

        if($request->isMethod('get')) {
            $token = $request->cookie($cookiesTokenCode);
            $name = $request->cookie($cookiesNameCode);
            $dateInfo = $request->cookie($cookiesDateCode);
        } else if ($request->isMethod('post')) {
            $token = $_COOKIE[$cookiesTokenCode];
            $name = $_COOKIE[$cookiesNameCode];
            $dateInfo = $_COOKIE[$cookiesDateCode];
        }

        $cookiesToken = fnEncryptPassword("WilEdi2019".$DataJSon->AppToken);
        $cookiesName = fnEncryptPassword($DataJSon->AppUserName.$DataJSon->AppDateInfo);
        $cookiesDate = fnEncryptPassword($DataJSon->AppDateInfo);

        // file_put_contents("token.txt","token: ".$token.", cookiesToken: ".$cookiesToken.", cookiesCode: ".$cookiesCode);

        if ( $token!=$cookiesToken || $name!=$cookiesName || $dateInfo!=$cookiesDate ) {
            $Data = ['success'=>false,
                     'message'=>'token expired! Please Refresh Your Page!',
                     // 'message'=>"  --- token : ". $token." --- ".$DataJSon->AppToken.
                     //            "  --- name : ". $name." --- ".$cookiesName.
                     //            "  --- dateInfo : ".$dateInfo." --- ".$cookiesDate,
                     'dateInfo'=>''];
            $Hasil = fnEncrypt(json_encode($Data), "");
            return response()->json($Hasil);
        }

        return $next($request)
                ->withCookie(cookie($cookiesTokenCode, $token, 20))
                ->withCookie(cookie($cookiesNameCode, $name, 20))
                ->withCookie(cookie($cookiesDateCode, $dateInfo, 20));
    }
}
