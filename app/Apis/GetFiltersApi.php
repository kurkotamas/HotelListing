<?php

namespace App\Apis;

use App\Models\City;
use App\Models\Country;
use CodeIgniter\RESTful\ResourceController;

class GetFiltersApi extends ResourceController
{
    protected $format = 'json';

    public function index()
    {

        $cityModel = new City();
        $countryModel = new Country();

        return $this->respond([
            'cities' => $cityModel->findAll(),
            'countries' => $countryModel->findAll(),
        ]);
    }

}