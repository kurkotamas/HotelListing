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
                'type'           => 'INT',
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type' => 'FLOAT',
            ],
            'countryId' => [
                'type' => 'INT',
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cityId' => [
                'type' => 'INT',
            ],
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->createTable('offers');
    }

    public function down()
    {
        $this->forge->dropTable('offers');
    }
}
