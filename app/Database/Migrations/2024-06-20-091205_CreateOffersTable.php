<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOffersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'offerId' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'hotelId' => [
                'type' => 'INT',
            ],
            'name' => [
                'type' => 'VARCHAR',
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
                'unsigned' => true,
            ],
            'cityId' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => true,
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
