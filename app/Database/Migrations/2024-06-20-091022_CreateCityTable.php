<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCityTable extends Migration
{
    public function up()
    {
        $this->db->query("create sequence cityId_seq start 1");

        $this->forge->addField([
            'cityId' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => false,
                'unique'         => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);

        $this->forge->createTable('cities');
        $this->forge->addKey('cityId', true);

        $this->db->query('alter table cities alter column "cityId" set default nextval(\'cityId_seq\');');
    }

    public function down()
    {
        $this->forge->dropTable('cities');
        $this->db->query("drop sequence if exists cityId_seq");
    }
}
