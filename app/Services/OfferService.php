<?php

namespace App\Services;

use App\Apis\SwissHalleyApi;
use App\Models\Offer;

class OfferService
{
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

    public function getOffers(): array
    {
        return $this->offer->findAll();
    }
}
