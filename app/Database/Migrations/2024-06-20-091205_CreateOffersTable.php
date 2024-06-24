<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOffersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'offerId' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'hotelId' => [
                'type' => 'INT',
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type' => 'FLOAT',
            ],
            'roundedPrice' => [
                'type' => 'INT',
            ],
            'countryId' => [
                'type' => 'INT',
            ],
            'cityId' => [
                'type' => 'INT',
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'default'    => null,
            ],
            'star' => [
                'type' => 'TINYINT',
                'default' => 0,
            ],
        ]);
        $this->forge->addKey('offerId', true);
        $this->forge->addForeignKey('cityId', 'cities', 'cityId', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('countryId', 'countries', 'countryId', 'CASCADE', 'CASCADE');
        $this->forge->createTable('offers');
    }

    public function down()
    {
        $this->forge->dropTable('offers');
    }
}
