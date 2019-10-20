<?php
/**
 * Created by PhpStorm.
 * User: kapil
 * Date: 25/9/19
 * Time: 1:20 PM
 */

namespace App\Utilities;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\StreamInterface;

class RequestHandler
{
    /**
     * @param $url
     * @param string $method
     * @param array $headersData
     * @param bool $params
     * @param array $authConfig
     * @return array|StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendRequest($url, $method = "GET", array $headersData = [], $params = false, array $authConfig = [])
    {
        try {
            $config = ['headers' => $headersData, 'verify' => false];

            if (count($authConfig)) {
                $config['auth'] = $authConfig;
            }

            $client = new Client($config);
            $params = $params ? ['form_params' => $params] : [];

            $res = $client->request($method, $url, $params);

            $data =  [
                'content' => $res->getBody()->getContents(),
                'res' => $res
            ];

            return $data;
        } catch (ClientException $e) {
            return $e->getResponse()->getBody(true);
        }
    }
}
