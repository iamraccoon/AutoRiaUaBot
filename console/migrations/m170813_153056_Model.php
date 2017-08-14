<?php
use yii\db\Migration;

class m170813_153056_Model extends Migration
{
    protected $tableNameGlossaryModel = 'glossaryModel';
    protected $tableNameGlossaryBrand = 'glossaryBrand';

    public function safeUp()
    {
        $this->createTable($this->tableNameGlossaryModel,
            [
                'id' => $this->primaryKey(),
                'brandId' => $this->integer(),
                'group' => $this->smallInteger(),
                'name' => $this->string(32)->notNull()
            ],
            'ENGINE = INNODB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci'
        );

        $this->createIndex('brandIdIdx', $this->tableNameGlossaryModel, 'brandId');
        $this->addForeignKey('modelToBrandfk', $this->tableNameGlossaryModel, 'brandId', $this->tableNameGlossaryBrand, 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('modelToBrandfk', $this->tableNameGlossaryModel);
        $this->dropTable($this->tableNameGlossaryModel);
    }
}
