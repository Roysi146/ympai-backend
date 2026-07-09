<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssessmentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_assessment' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'usia' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['Pria', 'Wanita'],
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'wilayah' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_assessment', true);
        $this->forge->createTable('assessment');
    }

    public function down()
    {
        $this->forge->dropTable('assessment');
    }
}
