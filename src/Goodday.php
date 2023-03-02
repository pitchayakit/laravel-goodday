<?php

namespace Lexicon\Goodday;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class Goodday
{
    public static function get($url)
    {
        $goodday_token = config('goodday.api_token');
        $client = new Client();
        $request = new Request('GET', "https://api.goodday.work/2.0/$url?gd-api-token=$goodday_token");
        $res = $client->sendAsync($request)->wait();

        return json_decode($res->getBody());
    } 

    public static function post($body, $url, $action = 'POST') {
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'gd-api-token' => config('goodday.api_token'),
        ];

        $body_dafault = [];
        if($user = Auth::user()) {
            $body_dafault ['createdByUserId'] = $user->goodday_id;
            $body_dafault ['fromUserId'] = $user->goodday_id;
        }
            
        $body = array_merge($body_dafault, $body);

        $request = new Request($action, "https://api.goodday.work/2.0/$url", $headers, json_encode($body));
        $res = $client->sendAsync($request)->wait();
        
        return json_decode($res->getBody());
    }

    public static function delete($url) {
        $client = new Client();
        $headers = [
            'gd-api-token' => config('goodday.api_token'),
        ];
        $request = new Request('DELETE', "https://api.goodday.work/2.0/$url", $headers);
        $res = $client->sendAsync($request)->wait();

        return json_decode($res->getBody());
    }
}
