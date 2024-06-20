<?php namespace App\Controllers;

use App\Services\OfferService;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;

    private OfferService $offerService;

    public function __construct()
    {
        $this->offerService = new OfferService();
    }

    public function index()
    {
        $offers = $this->offerService->getOffers();

        return view('home', ['offers' => $offers]);
    }
}
