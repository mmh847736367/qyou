<?php

namespace App;

use GuzzleHttp\Client;

class Spider
{
	static function curl_get($url,$refer) {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_REFERER,$refer);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0; Media Center PC 4.0; SLCC1; .NET CLR 3.0.04320)");
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_MAXREDIRS,5);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        $shuju=curl_exec($ch);
        curl_close($ch);
        return $shuju;
	}

	static function guzzle_get($url, $refer) {
        $client = new Client();

        $res = $client->get($url,[
            'timeout' => 5,
            'verify' => false,
            'stream' => true,
            'allow_redirects' => [
                'max'             => 10,        // allow at most 10 redirects.
                'strict'          => true,      // use "strict" RFC compliant redirects.
                'referer'         => true,      // add a Referer header
                'protocols'       => ['https'], // only allow https URLs
                'track_redirects' => true
            ],
            'headers' => [
                'Referer' => $refer,
                'User-Agent' => 'Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0; Media Center PC 4.0; SLCC1; .NET CLR 3.0.04320)',
            ]
        ]);
        return $res->getBody()->getContents();
    }
}