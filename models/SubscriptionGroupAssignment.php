<?php

namespace tina\subscriber\models;

/**
 * This is the model class for table "{{%subscription_group_assignment}}".
 *
 * @property integer $id
 * @property integer $subscriber_id
 * @property integer $group_id
 *
 * @property SubscriptionGroup $group
 * @property Subscriber $subscriber
 */
class SubscriptionGroupAssignment extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subscription_group_assignment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscriber_id', 'group_id'], 'required'],
            [['subscriber_id', 'group_id'], 'integer'],
            [
                ['group_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => SubscriptionGroup::className(),
                'targetAttribute' => ['group_id' => 'id'],
            ],
            [
                ['subscriber_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Subscriber::className(),
                'targetAttribute' => ['subscriber_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subscriber_id' => 'Subscriber ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(SubscriptionGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriber()
    {
        return $this->hasOne(Subscriber::className(), ['id' => 'subscriber_id']);
    }

    /**
     * @inheritdoc
     * @return SubscriptionGroupAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionGroupAssignmentQuery(get_called_class());
    }
}
