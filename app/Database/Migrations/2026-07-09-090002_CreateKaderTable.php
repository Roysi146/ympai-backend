<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKaderTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kader' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'id_wilayah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'status_aktif' => [
                'type'       => 'ENUM',
                'constraint' => ['Aktif', 'Non-aktif'],
                'default'    => 'Aktif',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_kader', true);
        $this->forge->addForeignKey('created_by', 'admin', 'id_admin', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_wilayah', 'wilayah', 'id_wilayah', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('kader');
    }

    public function down()
    {
        $this->forge->dropTable('kader');
    }
}
