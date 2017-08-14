<?php
use yii\db\Migration;

class m170813_154214_Currency extends Migration
{
    protected $tableName = 'glossaryCurrency';

    private $currency = [
        [1, 'доллары США'],
        [2, 'евро'],
        [3, 'гривна']
    ];

    public function safeUp()
    {
        $this->createTable($this->tableName,
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(32)->notNull()
            ],
            'ENGINE = INNODB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci'
        );

        $this->batchInsert($this->tableName, ['id', 'name'], $this->currency);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
