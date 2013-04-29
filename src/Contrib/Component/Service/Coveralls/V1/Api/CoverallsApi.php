<?php
namespace Contrib\Component\Service\Coveralls\V1\Api;

use Guzzle\Http\Client;
use Contrib\Component\Service\Coveralls\V1\Config\Configuration;

/**
 * Coveralls API client.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
abstract class CoverallsApi
{
    /**
     * Configuration.
     *
     * @var Contrib\Component\Service\Coveralls\V1\Config\Configuration
     */
    protected $config;

    /**
     * HTTP client.
     *
     * @var \Guzzle\Http\Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Configuration      $config Configuration.
     * @param \Guzzle\Http\Client $client HTTP client.
     */
    public function __construct(Configuration $config, Client $client = null)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * Log a message.
     *
     * @param string $message Log message.
     * @return string|null string if logged a message, null otherwise.
     */
    public function log($message)
    {
        if ($this->config->isVerbose()) {

            $stream = $this->config->isTestEnv() ? 'php://memory' : 'php://stdout';

            file_put_contents($stream, $message . PHP_EOL);

            return $message;
        }

        return null;
    }

    // accessor

    /**
     * Return configuration.
     *
     * @return \Contrib\Component\Service\Coveralls\V1\Config\Configuration
     */
    public function getConfiguration()
    {
        return $this->config;
    }

    /**
     * Set HTTP client.
     *
     * @param \Guzzle\Http\Client $client HTTP client.
     * @return \Contrib\Component\Service\Coveralls\V1\Api\CoverallsApi
     */
    public function setHttpClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Return HTTP client.
     *
     * @return \Guzzle\Http\Client
     */
    public function getHttpClient()
    {
        return $this->client;
    }
}
