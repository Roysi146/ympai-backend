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
            'id_admin' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'wilayah' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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
        ]);

        $this->forge->addKey('id_kader', true);
        $this->forge->addForeignKey('id_admin', 'admin', 'id_admin', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('kader');
    }

    public function down()
    {
        $this->forge->dropTable('kader');
    }
}
