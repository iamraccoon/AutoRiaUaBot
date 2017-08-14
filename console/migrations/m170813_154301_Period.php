<?php
use yii\db\Migration;

class m170813_154301_Period extends Migration
{
    protected $tableName = 'glossaryPeriod';

    private $period = [
        [0, 'за все время'],
        [1, 'за час'],
        [2, 'за сегодня'],
        [3, 'за три дня'],
        [4, 'за неделю'],
        [5, 'за месяц'],
        [6, 'за 3 месяца'],
        [8, 'за 3 часа'],
        [9, 'за 6 часов'],
        [10, 'за 2 дня'],
        [11, 'за сутки'],
        [14, 'за 12 часов']
    ];

    public function safeUp()
    {
        $this->createTable($this->tableName,
            [
                'id' => $this->primaryKey(),
                'code' => $this->smallInteger(3),
                'name' => $this->string(32)->notNull()
            ],
            'ENGINE = INNODB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci'
        );

        $this->batchInsert($this->tableName, ['code', 'name'], $this->period);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
