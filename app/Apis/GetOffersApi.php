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
        return $this->respond($this->offerService->getOffers($page));
    }
}