<?php
namespace models\glossary;

use yii\helpers\ArrayHelper;

/**
 * Class Glossary
 *
 * @property integer $id
 * @property string $name
 *
 * @package models\glossary
 */
abstract class Glossary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return lcfirst((new \ReflectionClass(get_called_class()))->getShortName());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * Get glossary data
     *
     * @return array
     */
    public function getGlossaryData()
    {
        $data = static::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    /**
     * Make batch insert data
     *
     * @param array $data Data from API
     * @param array $repository Repository
     * @param int $dependentId Id of dependent
     *
     * @return array
     */
    public function makeBatchInsertData($data, $repository, $dependentId)
    {
        $batchInsertData = [];
        foreach ($data as $cur) {
            if (!isset($repository[$cur['value']])) {
                $batchInsertData[] = [$cur['value'], $cur['name']];
            }
        }

        return $batchInsertData;
    }
}
