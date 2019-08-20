<?php

namespace tina\subscriber\models;

/**
 * This is the model class for table "{{%subscription_group_assignment}}".
 *
 * @property integer $id
 * @property integer $subscriberId
 * @property integer $groupId
 *
 * @property SubscriptionGroup $groupRelation
 * @property Subscriber $subscriberRelation
 */
class SubscriptionAssignment extends \yii\db\ActiveRecord
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
            [['subscriberId', 'groupId'], 'required'],
            [['subscriberId', 'groupId'], 'integer'],
            [
                ['groupId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => SubscriptionGroup::class,
                'targetAttribute' => ['groupId' => 'id'],
            ],
            [
                ['subscriberId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Subscriber::class,
                'targetAttribute' => ['subscriberId' => 'id'],
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
            'subscriberId' => 'Subscriber ID',
            'groupId' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRelation()
    {
        return $this->hasOne(SubscriptionGroup::class, ['id' => 'groupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriberRelation()
    {
        return $this->hasOne(Subscriber::class, ['id' => 'subscriberId']);
    }

    /**
     * @inheritdoc
     * @return SubscriptionAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionAssignmentQuery(get_called_class());
    }
}
