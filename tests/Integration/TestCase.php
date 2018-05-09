<?php
namespace Isign\Tests\Integration;

use Isign\Client;

/**
 * Base test case
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /** @var Client */
    protected $client;

    public function setUp()
    {
        $params = [
            'apiKey' => SANDBOX_API_KEY,
            'sandbox' => true,
        ];

        if (defined('SANDBOX_URL')) {
            $params['sandboxUrl'] = SANDBOX_URL;
        }

        $log = null;
        // Uncomment to enable request/response debugging
        // $log = new \Monolog\Logger('test');
        // $log->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout'));

        $this->client = Client::create($params, $log);
    }

    protected function sign($dtbs, $key)
    {
        openssl_sign(base64_decode($dtbs), $signatureValue, $key, OPENSSL_ALGO_SHA256);

        return base64_encode($signatureValue);
    }
}
