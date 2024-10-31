<?php

namespace AmazonAdsApi;

use Exception;

require_once 'Versions.php';
require_once 'Regions.php';
require_once 'CurlRequest.php';

/**
 * Class Client
 * Contains requests' wrappers of Amazon Ads API
 */
class Client
{
    use SponsoredProductsRequests;
    use SponsoredBrandsRequests;
    use SponsoredDisplayRequests;
    use ProductsRequests;
    use AccountsRequests;
    use StoresRequests;
    use AssetsRequests;
    use ReportingRequests;
    use AudiencesRequests;
    use HistoryRequests;
    use PostsRequests;
    use ExportsRequests;
    use MarketingStream;

    public const CAMPAIGN_TYPE_SPONSORED_PRODUCTS_FULL = 'sponsoredProducts';
    public const CAMPAIGN_TYPE_SPONSORED_BRANDS_FULL = 'sponsoredBrands';
    public const CAMPAIGN_TYPE_SPONSORED_DISPLAY_FULL = 'sponsoredDisplay';
    public const CAMPAIGN_TYPE_SPONSORED_PRODUCTS = 'sp';
    public const CAMPAIGN_TYPE_SPONSORED_BRANDS = 'sb';
    public const CAMPAIGN_TYPE_SPONSORED_DISPLAY = 'sd';

    private $config = [
        'clientId' => null,
        'clientSecret' => null,
        'region' => null,
        'accessToken' => null,
        'refreshToken' => null,
        'sandbox' => false,
        'saveFile' => true,
        'apiVersion' => 'v1',
        'sbVersion' => 'v4',
        'sdVersion' => 'v3',
        'spVersion' => 'v3',
        'portfoliosVersion' => 'v1',
        'reportsVersion' => 'v3',
        'deleteGzipFile' => false,
        'isUseProxy' => false,
        'guzzleProxy' => '',
        'curlProxy' => '',
        'appUserAgent' => '',
        'headerAccept' => '',
        'profileId' => 0,
        'timeout' => 30,
    ];

    private $apiVersion;
    private $sbVersion;
    private $sdVersion;
    private $spVersion;
    private $portfoliosVersion;
    private $reportsVersion;
    private $applicationVersion;
    public $campaignTypePrefix;
    private $userAgent;
    private $isUseProxy = false;
    private $endpoint = null;
    private $tokenUrl = null;
    private $requestId = null;
    private $endpoints;
    private $versionStrings;
    private $headerAccept;
    private $tokenTimeOut = null;
    public $profileId = null;
    public $headers = [];
    private $versions = null;
    protected $debug = false;

    /**
     * Client constructor.
     * @param $config
     * @throws Exception
     */
    public function __construct($config)
    {
        $this->config = $config;
        $regions = new Regions();
        $this->endpoints = $regions->endpoints;
        $this->versions = new Versions();
        $this->versionStrings = $this->versions->versionStrings;
        $this->apiVersion = $config['apiVersion'] ?? '';
        $this->sbVersion = $config['sdVersion'] ?? '';
        $this->spVersion = $config['spVersion'] ?? '';
        $this->portfoliosVersion = $config['portfoliosVersion'] ?? '';
        $this->reportsVersion = $config['reportsVersion'] ?? '';
        $this->apiVersion = is_null($this->apiVersion) ? $this->versionStrings['apiVersion'] : $this->apiVersion;
        $this->applicationVersion = $this->versionStrings['applicationVersion'];
        $this->userAgent = $config['appUserAgent'];
        $this->headerAccept = $config['headerAccept'] ?? '';
        $this->tokenTimeOut = $config['tokenTimeOut'] ?? null;
        $this->validateConfig($config);
        $this->validateConfigParameters();
        $this->setEndpoints();

        if (is_null($this->config['accessToken']) && !is_null($this->config['refreshToken'])) {
            $this->doRefreshToken();
        }

        if (isset($config['profileId'])) {
            $this->profileId = $config['profileId'] ?? null;
        }

        if ($this->tokenTimeOut) {
            $this->checkTokenTimeOut();
        }
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value)
    {
        if (isset($this->{$name})) {
            $this->{$name} = $value;
        }
    }

    public function checkTokenTimeOut()
    {
        if (date('Y-m-d H:i:s') > $this->tokenTimeOut) {
            $this->logAndThrow("Token time outed.");
        }
    }

    public function setDebug(bool $debug = false)
    {
        $this->debug = $debug;
    }


    /**
     * @return array
     * @throws Exception
     */
    public function doRefreshToken($refresh_token)
    {
        $this->config['accessToken'] = $refresh_token;

    }

    /**
     * @param string $interface
     * @param array|null $params
     * @param string $method
     * @param bool $needAccept
     * @return array
     * @throws Exception
     */
    private function operation(
        string $interface,
        ?array $params = [],
        string $method = "GET",
        bool   $needAccept = true
    ): array
    {
        $headers = array(
            'Authorization: bearer ' . $this->config['accessToken'],
            'User-Agent: ' . $this->userAgent,
            'Amazon-Advertising-API-ClientId: ' . $this->config['clientId'],
            'Accept-Encoding: gzip, deflate, br',//默认gzip
            'Connection: keep-alive',//默认长连接
        );
        if (!is_null($this->profileId)) {
            $headers[] = 'Amazon-Advertising-API-Scope: ' . $this->profileId;
        }
        $accept = $this->versions->accept('/' . $interface);
        //headers插入第一个数组
        array_unshift($headers, $accept ? 'Accept: ' . $accept : 'Accept: application/' . $this->versions->getVersionJson('/' . $interface));

        $headers[] = 'Content-Type: application/' . $this->versions->getVersionJson('/' . $interface);
        if ($this->debug) {
            print_r($headers);
            print_r($params);
        }
        $this->headers = $headers;
        $request = new CurlRequest($this->config);
        $this->endpoint = trim($this->endpoint, "/");
        $url = "$this->endpoint/$interface";
        $this->requestId = null;
        $request->method = $method;
        switch (strtolower($method)) {
            case 'get':
                if (!empty($params)) {
                    $url .= '?';
                    foreach ($params as $k => $v) {
                        $url .= "$k=" . rawurlencode($v) . '&';
                    }
                    $url = rtrim($url, '&');
                }
                break;
            case 'put':
            case 'post':
            case 'delete':
                if (!empty($params)) {
                    $data = json_encode($params);
                    $request->setOption(CURLOPT_POST, true);
                    $request->setOption(CURLOPT_POSTFIELDS, $data);
                }
                break;
            default:
                $this->logAndThrow("Unknown verb $method.");
        }
        $request->setOption(CURLOPT_URL, $url);
        $request->setOption(CURLOPT_HTTPHEADER, $this->headers);
        $request->setOption(CURLOPT_USERAGENT, $this->userAgent);
        $request->setOption(CURLOPT_CUSTOMREQUEST, strtoupper($method));
        //超时
        $request->setOption(CURLOPT_TIMEOUT, $this->config['timeout'] ?? 30);
        $request->setOption(CURLOPT_CONNECTTIMEOUT, 5); // 连接超时5秒
        return $this->executeRequest($request);
    }

    /**
     * @param CurlRequest $request
     * @return array
     */
    protected function executeRequest(CurlRequest $request): array
    {
        $response = $request->execute();
        $this->requestId = $request->requestId;
        $response_info = $request->getInfo();
        $request->close();
        if ($response_info['http_code'] == 307) {
            /* application/octet-stream */
            return $this->download($response_info['redirect_url'], true);
        }
        $json = json_decode($response, true);
        if (!preg_match('/^(2|3)\d{2}$/', $response_info['http_code'])) {
            $result = array(
                'success' => false,
                'code' => $response_info['http_code'],
                'response' => is_array($response) ? $response : $json,
                'requestId' => $this->requestId
            );
        } else {
            $result = array(
                'success' => true,
                'code' => $response_info['http_code'],
                'response' => is_array($response) ? $response : $json,
                'requestId' => $this->requestId
            );

        }
        if ($this->debug) {
            $result['responseInfo'] = $response_info;
        }
        return $result;
    }

    /**
     * @param $config
     * @return bool
     * @throws Exception
     */
    private function validateConfig($config): bool
    {
        if (is_null($config)) {
            $this->logAndThrow("'config' cannot be null.");
        }

        foreach ($config as $k => $v) {
            if (array_key_exists($k, $this->config)) {
                $this->config[$k] = $v;
            } else {
                $this->logAndThrow("Unknown parameter $k in config.");
            }
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     */
    private function validateConfigParameters(): bool
    {
        foreach ($this->config as $k => $v) {
            if (is_null($v) && $k !== 'accessToken' && $k !== 'refreshToken') {
                $this->logAndThrow("Missing required parameter $k.");
            }
            switch ($k) {
                case 'clientId':
                    if (!preg_match("/^amzn1\.application-oa2-client\.[a-z0-9]{32}$/i", $v)) {
                        $this->logAndThrow('Invalid parameter value for clientId.');
                    }
                    break;
                case 'clientSecret':
                    if (
                        !preg_match("/^[a-z0-9]{64}$/i", $v) &&
                        !preg_match("/^amzn1\.oa2-cs\.v1\.[a-z0-9]{64}$/i", $v)
                    ) {
                        $this->logAndThrow('Invalid parameter value for clientSecret.');
                    }
                    break;
                case 'accessToken':
                    if (!is_null($v)) {
                        if (!preg_match("/^Atza(\||%7C|%7c).*$/", $v)) {
                            $this->logAndThrow('Invalid parameter value for accessToken.');
                        }
                    }
                    break;
                case 'refreshToken':
		    return true;
                    if (!is_null($v)) {
                        if (!preg_match("/^Atzr(\||%7C|%7c).*$/", $v)) {
                            $this->logAndThrow('Invalid parameter value for refreshToken.');
                        }
                    }
                    break;
                case 'sandbox':
                    if (!is_bool($v)) {
                        $this->logAndThrow('Invalid parameter value for sandbox.');
                    }
                    break;
                case 'saveFile':
                    if (!is_bool($v)) {
                        $this->logAndThrow('Invalid parameter value for saveFile.');
                    }
                    break;
            }
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     */
    private function setEndpoints(): bool
    {
        /* check if region exists and set api/token endpoints */
        if (array_key_exists(strtolower($this->config['region']), $this->endpoints)) {
            $region_code = strtolower($this->config['region']);
            if ($this->config['sandbox']) {
                $this->endpoint = "https://{$this->endpoints[$region_code]['sandbox']}/";
            } else {
                $this->endpoint = "https://{$this->endpoints[$region_code]['prod']}/";
            }
            $this->tokenUrl = $this->endpoints[$region_code]['tokenUrl'];
        } else {
            $this->logAndThrow('Invalid region.');
        }
        return true;
    }

    /**
     * @param $message
     * @throws Exception
     */
    private function logAndThrow($message)
    {
        throw new Exception($message);
    }
}
