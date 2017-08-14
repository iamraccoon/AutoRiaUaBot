<?php
namespace models\glossary;

/**
 * This is the model class for table "glossaryState"
 *
 * @property integer $id
 * @property string $name
 *
 * @property GlossaryCity[] $glossaryCities
 */
class GlossaryState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'glossaryState';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
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
    public function getGlossaryCities()
    {
        return $this->hasMany(GlossaryCity::className(), ['stateId' => 'id']);
    }
}
