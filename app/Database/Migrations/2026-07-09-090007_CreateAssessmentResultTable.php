<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssessmentResultTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hasil' => [
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
            'skor_depression' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'skor_anxiety' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'skor_stress' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'severity_depression' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'severity_anxiety' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'severity_stress' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_hasil', true);
        $this->forge->addUniqueKey('id_assessment');
        $this->forge->addForeignKey('id_assessment', 'assessment', 'id_assessment', 'CASCADE', 'CASCADE');
        $this->forge->createTable('assessment_result');
    }

    public function down()
    {
        $this->forge->dropTable('assessment_result');
    }
}
