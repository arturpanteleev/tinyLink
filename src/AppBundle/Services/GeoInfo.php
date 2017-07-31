<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class GeoInfo
{
    const API_LINK = 'http://freegeoip.net/json/';

    /**
     * @var integer;
     */
    private $ip;

    /**
     * @var array
     */
    private $ipInfo;

    public function __construct(RequestStack $requestStack)
    {
        $this->ip = $requestStack->getCurrentRequest()->getClientIp();
        //mock for localhost $this->ip = '95.27.195.255';
        $this->ipInfo = $this->getIpInfo();
    }

    public function getCity(): string
    {
        return $this->getIpInfoByKey('city');
    }

    public function getCountry(): string
    {
        return $this->getIpInfoByKey('country_name');
    }

    private function getIpInfo(): array
    {
        return (array) json_decode(file_get_contents(self::API_LINK.$this->ip));
    }

    private function getIpInfoByKey(string $keyName): string
    {
        if (isset($this->ipInfo[$keyName])) {
            return $this->ipInfo[$keyName];
        } else {
            return null;
        }
    }
}
