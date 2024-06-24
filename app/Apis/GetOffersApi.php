<?php

namespace App\Apis;

use App\Services\OfferService;
use CodeIgniter\RESTful\ResourceController;

class GetOffersApi extends ResourceController
{
    protected $modelName = 'App\Models\Offer';
    protected $format = 'json';
    private OfferService $offerService;

    public function __construct()
    {
        $this->offerService = new OfferService();
    }

    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $cityIds = $this->request->getVar('cityIds');
        $cityIds = $cityIds ? array_map('intval', explode(',', $cityIds)) : [];
        $countryIds = $this->request->getVar('countryIds');
        $countryIds = $countryIds ? array_map('intval', explode(',', $countryIds)) : [];
        $orderBy = $this->request->getVar('order_by') ?? 'price';
        $direction = $this->request->getVar('direction') ?? 'asc';

        return $this->respond($this->offerService->getOffers($page, $orderBy, $cityIds, $countryIds, $direction));
    }
}