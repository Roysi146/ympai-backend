<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssessmentQuestionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_soal' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_admin' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'subscale' => [
                'type'       => 'ENUM',
                'constraint' => ['depression', 'anxiety', 'stress'],
            ],
            'teks_soal' => [
                'type' => 'TEXT',
            ],
            'urutan' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
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

        $this->forge->addKey('id_soal', true);
        $this->forge->addForeignKey('id_admin', 'admin', 'id_admin', 'CASCADE', 'SET NULL');
        $this->forge->createTable('assessment_question');
    }

    public function down()
    {
        $this->forge->dropTable('assessment_question');
    }
}
