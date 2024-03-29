<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Lyranetwork\Lyra\Model\Api;


class LyraRest
{
    const SDK_VERSION = '1.0.2';

    private $endpoint = null;
    private $privateKey = null;
    private $connectionTimeout = 45;
    private $timeout = 45;
    private $proxyHost = null;
    private $proxyPort = null;

    public function __construct($endpoint, $site_id, $password)
    {
        if (empty($endpoint)) {
            throw new \InvalidArgumentException('Endpoint parameter is mandatory.');
        }

        if (empty($site_id)) {
            throw new \InvalidArgumentException('Site ID is mandatory.');
        }

        if (empty($password)) {
            throw new \InvalidArgumentException('Private key is mandatory.');
        }

        $this->endpoint = $endpoint;
        $this->privateKey = $site_id . ':' . $password;
    }

    public function getVersion()
    {
        return self::SDK_VERSION;
    }

    public function setProxy($host, $port)
    {
        $this->proxyHost = $host;
        $this->proxyPort = $port;
    }

    public function setTimeouts($connection_timeout, $timeout)
    {
        $this->connectionTimeout = $connection_timeout;
        $this->timeout = $timeout;
    }

    public function post($target, $data)
    {
        if (extension_loaded('curl')) {
            return $this->curlPost($target, $data);
        } else {
            return $this->fallbackPost($target, $data);
        }
    }

    public function curlPost($target, $data)
    {
        $url = $this->endpoint . $target;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'CONTRIB REST API PHP SDK ' . $this->getVersion());
        curl_setopt($curl, CURLOPT_USERPWD, $this->privateKey);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);

        /* we disable SSL validation for test key because there is
         * lot of wamp installation that does not handle certificates well
         */
        if (strpos($this->privateKey, 'testpassword_') !== false) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        }

        if ($this->proxyHost && $this->proxyPort) {
            curl_setopt($curl, CURLOPT_PROXY, $this->proxyHost);
            curl_setopt($curl, CURLOPT_PROXYPORT, $this->proxyPort);
        }

        $raw_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (!in_array($status, array(200, 401))) {
            curl_close($curl);

            throw new \Exception("Error: call to URL $url failed with unexpected status $status, response $raw_response.");
        }

        $response = json_decode($raw_response, true);
        if (!is_array($response)) {
            $error = curl_error($curl);
            $errno = curl_errno($curl);

            curl_close($curl);

            throw new \Exception("Error: call to URL $url failed, response $raw_response, curl_error $error, curl_errno $errno.");
        }

        curl_close($curl);

        return $response;
    }

    public function fallbackPost($target, $data)
    {
        $url = $this->endpoint . $target;

        $http = array(
            'method'  => 'POST',
            'header'  => 'Authorization: Basic ' . base64_encode($this->privateKey) . "\r\n".
                         'Content-Type: application/json',
            'content' => $data,
            'user_agent' => 'CONTRIB REST API PHP SDK ' . $this->getVersion(),
            'timeout' => $this->timeout
        );

        if ($this->proxyHost && $this->proxyPort) {
            $http['proxy'] = $this->proxyHost . ':' . $this->proxyPort;
        }

        $ssl = array();
        if (strpos($this->privateKey, 'testpassword_') !== false) {
            $ssl['verify_peer'] = false;
            $ssl['verify_peer_name']  = false;
        }

        $context = stream_context_create(array('http' => $http, 'ssl' => $ssl));
        $raw_response = file_get_contents($url, false, $context);

        if (!$raw_response) {
            throw new \Exception("Error: call to URL $url failed.");
        }

        $response = json_decode($raw_response, true);
        if (!is_array($response)) {
            throw new \Exception("Error: call to URL $url failed, response $raw_response.");
        }

        return $response;
    }
}
