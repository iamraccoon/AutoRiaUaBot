<?php
namespace models\glossary;

/**
 * This is the model class for table "glossaryBrand"
 *
 * @property integer $id
 * @property string $name
 *
 * @property GlossaryModel[] $glossaryModels
 */
class GlossaryBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'glossaryBrand';
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
     * @return \yii\db\ActiveQuery
     */
    public function getGlossaryModels()
    {
        return $this->hasMany(GlossaryModel::className(), ['brandId' => 'id']);
    }
}
