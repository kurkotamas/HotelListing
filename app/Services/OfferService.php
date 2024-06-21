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

    public function getOffers(int $page = 1, int $perPage = self::PER_PAGE, string $orderBy = 'price'): array
    {
        $offers = $this->offer->orderBy($orderBy)->paginate($perPage, 'default', $page);
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
