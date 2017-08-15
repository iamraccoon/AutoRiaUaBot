<?php
namespace models\glossary;

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
}
