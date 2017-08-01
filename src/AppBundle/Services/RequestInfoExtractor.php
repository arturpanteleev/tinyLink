<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Класс обертка для получения разных данных из запроса
 *
 * Class RequestInfoExtractor
 */
class RequestInfoExtractor
{
	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @var GeoInfo
	 */
	private $geoInfo;

	/**
	 * RequestInfoExtractor constructor.
	 * @param RequestStack $requestStack
	 * @param GeoInfo $geoInfo
	 */
	public function __construct(RequestStack $requestStack, GeoInfo $geoInfo)
	{
		$this->request = $requestStack->getCurrentRequest();
		$this->geoInfo = $geoInfo;
	}

	public function getGeo(): string
	{

		$geo = '';

		$country = $this->geoInfo->getCountry();
		if (!empty($country))
		{
			$geo .= $country . ' ';
		}

		$city = $this->geoInfo->getCity();
		if (!empty($city))
		{
			$geo .= $city;
		}

		return $geo;
	}

	public function getUserAgent(): string
	{
		return $this->request->headers->get('User-Agent');
	}
}
