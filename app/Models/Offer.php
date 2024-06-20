<?php

namespace App\Models;

use CodeIgniter\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $primaryKey = 'offerId';
    protected $allowedFields = ['hotelId', 'name', 'price', 'cityId', 'city', 'countryId', 'country', 'image', 'star'];
}