<?php

namespace App\Services;

use App\Apis\SwissHalleyApi;
use App\Models\Offer;

class OfferService
{
    const PER_PAGE = 21;

    protected Offer $offer;

    private SwissHalleyApi $swissHalleyApi;

    public function __construct()
    {
        $this->offer = new Offer();
        $this->swissHalleyApi = new SwissHalleyApi();
    }

    public function getOffersFromApi()
    {
        return $this->swissHalleyApi->getOffersFromApi();
    }

    public function getOffers(int $page = 1, string $orderBy = 'price', array $cityIds = [], array $countryIds = [],
      string $direction = 'asc', int $perPage = self::PER_PAGE): array
    {
        $offers = $this->offer
            ->select('offers.*, cities.name as cityName, countries.name as countryName')
            ->join('cities', 'cities.cityId = offers.cityId')
            ->join('countries', 'countries.countryId = offers.countryId')
            ->orderBy($orderBy, $direction);

            if ($cityIds) {
                $offers->orWhereIn('offers.cityId', $cityIds);
            }

            if ($countryIds) {
                $offers->orWhereIn('offers.countryId', $countryIds);
            }

        $offers = $offers->paginate($perPage, 'default', $page);
        $pager = $this->offer->pager;

        return [
            'offers' => $offers,
            'pager' => [
                'currentPage' => $pager->getCurrentPage(),
                'totalPages' => $pager->getPageCount(),
                'totalItems' => $pager->getTotal(),
                'perPage' => $pager->getPerPage(),
            ]
        ];
    }
}
