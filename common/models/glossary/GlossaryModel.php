<?php
namespace models\glossary;

/**
 * This is the model class for table "glossaryModel"
 *
 * @property integer $id
 * @property integer $brandId
 * @property integer $group
 * @property string $name
 *
 * @property GlossaryBrand $brand
 */
class GlossaryModel extends Glossary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brandId', 'group'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['brandId'], 'exist', 'skipOnError' => true, 'targetClass' => GlossaryBrand::className(), 'targetAttribute' => ['brandId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brandId' => 'Brand ID',
            'group' => 'Group',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(GlossaryBrand::className(), ['id' => 'brandId']);
    }
}
