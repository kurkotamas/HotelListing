<?php

namespace App\Commands;

use App\Models\City;
use App\Models\Country;
use App\Models\Offer;
use App\Services\OfferService;
use CodeIgniter\CLI\BaseCommand;

/**
 * php spark offers:fetch
 */
class FetchOffers extends BaseCommand
{
    protected $group       = 'offers';
    protected $name        = 'offers:fetch';
    protected $description = 'Fetch offers from the API and update the database';


    public function run(array $params)
    {
        $offers = [];
        $cities = [];
        $countries = [];
        $offerService = new OfferService();
        $rawOffers = $offerService->getOffersFromApi();
        $db = db_connect();

        foreach ($rawOffers['data']['hotels'] as $offer) {
            $hotelId = $offer['hotel_id'];
            $image = $offer['image'];

            if (empty($offers[$hotelId]) || $offers[$hotelId]['price'] > $offer['price']) {
                $offers[$hotelId] = [
                    'hotelId' => $hotelId,
                    'price' => $offer['price'],
                    'roundedPrice' => ceil($offer['price']),
                    'name' => $offer['hotel_name'],
                    'cityId' => $offer['city_id'],
                    'countryId' => $offer['country_id'],
                    'star' => $offer['star'],
                    'image' => $image ?? $offers[$hotelId]['image'] ?? null,
                ];
                if (!in_array($offer['city_id'], $cities)) {
                    $cities[$offer['city_id']] = $offer['city'];
                }
                if (!in_array($offer['country_id'], $countries)) {
                    $countries[$offer['country_id']] = $offer['country'];
                }
            }

            if (!$offers[$hotelId]['image'] && $image) {
                $offers[$hotelId]['image'] = $image;
            }

        }

        $cityModel = new City();
        $db->query("SELECT nextval('cityId_seq')");
        foreach ($cities as $cityId => $city) {
            $cityModel->insert([
                'cityId' => $cityId,
                'name' => $city,
            ], false);
        }

        $countryModel = new Country();
        $db->query("SELECT nextval('countryId_seq')");
        foreach ($countries as $countryId => $country) {
            $countryModel->insert([
                'countryId' => $countryId,
                'name' => $country,
            ]);
        }

        $offerModel = new Offer();
        foreach ($offers as $offer) {
            $offerModel->insert($offer);
        }
    }
}