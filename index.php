<?php
require 'vendor/autoload.php';

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\Promise;


$client = new Client();
$cuba = '';
$promises = [
    'cuba' => $client->getAsync('https://tiny-bean.test/api/cuba', ['verify' => false])->then(function ($response){ return $response->getBody();}),
    'fintech' => $client->getAsync('https://tiny-bean.test/api/cuba', ['verify' => false])->then(function ($response){ return $response->getBody();}),
];

echo Carbon::now(). '<br />';
$results = GuzzleHttp\Promise\unwrap($promises);
 
// Please wait for a while to complete
// the requests(some of them may fail)
$results = GuzzleHttp\Promise\settle($promises)->wait();
print_r($results['cuba']['value']->getContents());   
echo '<br />';
print_r($results['fintech']['value']->getContents());   
//print "finish/over." . PHP_EOL;
echo '<br />';
echo Carbon::now(). '<br />';

$var = 'test';
$request = new Request('get', 'https://tiny-bean.test/api/cuba', ['verify' => false]);
$promise = $client->sendAsync($request)->then(
        function ($response) {
            return $response->getBody();
        }
    );
echo '<br />';
echo Carbon::now(). '<br />';
$data = $promise->wait();
echo $var.' : '.$data. '<br />';
echo Carbon::now();