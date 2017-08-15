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
class GlossaryState extends Glossary
{
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
     * @return \yii\db\ActiveQuery
     */
    public function getGlossaryCities()
    {
        return $this->hasMany(GlossaryCity::className(), ['stateId' => 'id']);
    }
}
