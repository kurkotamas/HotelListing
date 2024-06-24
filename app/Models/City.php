<?php

namespace App\Models;

use CodeIgniter\Model;

class City  extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'cityId';
    protected $allowedFields = ['cityId', 'name'];
}