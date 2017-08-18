<?php
namespace models\glossary;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "glossaryCity"
 *
 * @property integer $id
 * @property integer $stateId
 * @property string $name
 *
 * @property GlossaryState $state
 */
class GlossaryCity extends Glossary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stateId'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['stateId'], 'exist', 'skipOnError' => true, 'targetClass' => GlossaryState::className(), 'targetAttribute' => ['stateId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stateId' => 'State ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(GlossaryState::className(), ['id' => 'stateId']);
    }

    /**
     * Get glossary cities
     *
     * @return array
     */
    public function getGlossaryData()
    {
        $data = static::find()->asArray()->all();
        $citiesByState = ArrayHelper::index($data, null, 'stateId');
        foreach ($citiesByState as $stateId => $cities) {
            $citiesByState[$stateId] = ArrayHelper::map($cities, 'id', 'name');
        }

        return $citiesByState;
    }

    /**
     * @inheritdoc
     */
    public function makeBatchInsertData($data, $repository, $dependentId)
    {
        $batchInsertData = [];
        foreach ($data as $cur) {
            if (!isset($repository[$cur['value']])) {
                $batchInsertData[] = [$cur['value'], $dependentId, $cur['name']];
            }
        }

        return $batchInsertData;
    }
}
