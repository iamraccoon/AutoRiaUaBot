<?php
use yii\db\Migration;

class m170813_154426_ErrorsType extends Migration
{
    protected $tableName = 'glossaryErrorsType';

    private $errorsType = [
        [403, 'API_KEY_MISSING'],
        [403, 'API_KEY_INVALID'],
        [403, 'API_KEY_DISABLED'],
        [403, 'API_KEY_UNAUTHORIZED'],
        [403, 'API_KEY_UNVERIFIED'],
        [400, 'HTTPS_REQUIRED'],
        [429, 'OVER_RATE_LIMIT'],
        [404, 'NOT_FOUND']
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

        $this->batchInsert($this->tableName, ['code', 'name'], $this->errorsType);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
