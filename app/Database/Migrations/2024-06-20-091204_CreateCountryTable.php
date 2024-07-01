<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCountryTable extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'countryId' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('countryId', true);
        $this->forge->createTable('countries');
    }

    public function down()
    {
        $this->forge->dropTable('countries');
    }
}
