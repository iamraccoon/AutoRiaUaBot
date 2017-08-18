<?php
namespace models\glossary;

use yii\helpers\ArrayHelper;

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

    /**
     * Get glossary cities
     *
     * @return array
     */
    public function getGlossaryData()
    {
        $data = static::find()->asArray()->all();
        $modelsByState = ArrayHelper::index($data, null, 'brandId');
        foreach ($modelsByState as $modelId => $group) {
            $modelsByState[$modelId] = ArrayHelper::map($group, 'id', 'name', 'group');
        }

        return $modelsByState;
    }

    /**
     * @inheritdoc
     */
    public function makeBatchInsertData($data, $repository, $dependentId)
    {
        $batchInsertData = [];
        foreach ($data as $groupId => $cur) {
            if (empty($cur[0]['value'])) {
                $batchInsertData[] = [$cur['value'], $dependentId, NULL, $cur['name']];
            } else {
                foreach ($cur as $model) {
                    $batchInsertData[] = [$model['value'], $dependentId, $groupId, $model['name']];
                }
            }
        }

        return $batchInsertData;
    }
}
