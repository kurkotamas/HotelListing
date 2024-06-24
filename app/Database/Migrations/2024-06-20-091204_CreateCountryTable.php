<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCountryTable extends Migration
{
    public function up()
    {
        $this->db->query("create sequence countryId_seq start 1");

        $this->forge->addField([
            'countryId' => [
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
        $this->forge->addKey('countryId', true);
        $this->forge->createTable('countries');

        $this->db->query('alter table countries alter column "countryId" set default nextval(\'countryId_seq\');');
    }

    public function down()
    {
        $this->forge->dropTable('countries');
        $this->db->query("drop sequence if exists countryId_seq");

    }
}
