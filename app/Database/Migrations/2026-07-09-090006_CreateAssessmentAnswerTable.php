<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssessmentAnswerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jawaban' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_assessment' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_soal' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nilai_jawaban' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
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

        $this->forge->addKey('id_jawaban', true);
        $this->forge->addUniqueKey(['id_assessment', 'id_soal']);
        $this->forge->addForeignKey('id_assessment', 'assessment', 'id_assessment', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_soal', 'assessment_question', 'id_soal', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('assessment_answer');
    }

    public function down()
    {
        $this->forge->dropTable('assessment_answer');
    }
}
