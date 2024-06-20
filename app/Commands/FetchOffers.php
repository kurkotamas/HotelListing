<?php

namespace App\Commands;

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
        $offerService = new OfferService();
        $rawOffers = $offerService->getOffersFromApi();

        foreach ($rawOffers['data']['hotels'] as $offer) {
            $hotelId = $offer['hotel_id'];
            $image = $offer['image'];

            if (empty($offers[$hotelId]) || $offers[$hotelId]['price'] > $offer['price']) {
                $offers[$hotelId] = [
                    'hotelId' => $hotelId,
                    'price' => $offer['price'],
                    'name' => $offer['hotel_name'],
                    'cityId' => $offer['city_id'],
                    'city' => $offer['city'],
                    'countryId' => $offer['country_id'],
                    'country' => $offer['country'],
                    'star' => $offer['star'],
                    'image' => $image ?? $offers[$hotelId]['image'] ?? null,
                ];
            }

            if (!$offers[$hotelId]['image'] && $image) {
                $offers[$hotelId]['image'] = $image;
            }

        }

        foreach ($offers as $offer) {
            $offerModel = new Offer();
            $offerModel->insert($offer);
        }
    }
}