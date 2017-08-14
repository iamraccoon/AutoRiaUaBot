<?php
namespace models\glossary;

/**
 * This is the model class for table "glossaryCity"
 *
 * @property integer $id
 * @property integer $stateId
 * @property string $name
 *
 * @property GlossaryState $state
 */
class GlossaryCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'glossaryCity';
    }

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
}
