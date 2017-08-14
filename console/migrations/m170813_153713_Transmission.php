<?php
use yii\db\Migration;

class m170813_153713_Transmission extends Migration
{
    protected $tableName = 'glossaryTransmission';

    public function safeUp()
    {
        $this->createTable($this->tableName,
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(32)->notNull()
            ],
            'ENGINE = INNODB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci'
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
