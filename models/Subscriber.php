<?php

namespace tina\subscriber\models;

use krok\extend\behaviors\TimestampBehavior;
use voskobovich\behaviors\ManyToManyBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%subscriber}}".
 *
 * @property integer $id
 * @property string $email
 * @property string $country
 * @property string $city
 * @property integer $ip
 * @property string $link
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property SubscriptionGroup[] $groupRelation
 */
class Subscriber extends \yii\db\ActiveRecord
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
     * @return array
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
            'ManyToManyBehavior' => [
                'class' => ManyToManyBehavior::class,
                'relations' => [
                    'groupIDs' => 'groupRelation',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subscriber}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['createdAt', 'updatedAt', 'ip', 'country', 'city', 'link'], 'safe'],
            [['groupIDs'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'country' => 'Страна',
            'city' => 'Город',
            'ip' => 'Ip',
            'link' => 'Адрес страницы',
            'createdAt' => 'Добавлен',
            'updatedAt' => 'Обновлен',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRelation()
    {
        return $this->hasMany(SubscriptionGroup::class, ['id' => 'group_id'])
            ->viaTable(SubscriptionGroupAssignment::tableName(),
                ['subscriber_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getGroupsString()
    {
        $list = ArrayHelper::getColumn($this->groupRelation, 'title');
        if (count($list) > 0) {
            return implode(', ', $list);
        } else {
            return "Ничего не выбрано";
        }
    }

    /**
     * @inheritdoc
     * @return SubscriberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriberQuery(get_called_class());
    }
}
