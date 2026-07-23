<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateParentSchoolProgramTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_program' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kader' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_wilayah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tujuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'jumlah_peserta' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
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

        $this->forge->addKey('id_program', true);
        $this->forge->addForeignKey('id_kader', 'kader', 'id_kader', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_wilayah', 'wilayah', 'id_wilayah', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('parent_school_program');
    }

    public function down()
    {
        $this->forge->dropTable('parent_school_program');
    }
}
