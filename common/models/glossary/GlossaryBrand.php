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
class GlossaryBrand extends Glossary
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGlossaryModels()
    {
        return $this->hasMany(GlossaryModel::className(), ['brandId' => 'id']);
    }
}
