<?php
use yii\db\Migration;

class m170813_153424_City extends Migration
{
    protected $tableNameGlossaryCity = 'glossaryCity';
    protected $tableNameGlossaryState = 'glossaryState';

    public function safeUp()
    {
        $this->createTable($this->tableNameGlossaryCity,
            [
                'id' => $this->primaryKey(),
                'stateId' => $this->integer(),
                'name' => $this->string(64)->notNull()
            ],
            'ENGINE = INNODB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci'
        );

        $this->createIndex('stateIdIdx', $this->tableNameGlossaryCity, 'stateId');
        $this->addForeignKey('cityToStatefk', $this->tableNameGlossaryCity, 'stateId', $this->tableNameGlossaryState, 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('cityToStatefk', $this->tableNameGlossaryCity);
        $this->dropTable($this->tableNameGlossaryCity);
    }
}
