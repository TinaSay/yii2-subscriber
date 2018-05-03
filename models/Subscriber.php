<?php

namespace tina\subscriber\models;

use krok\extend\behaviors\TimestampBehavior;
use voskobovich\behaviors\ManyToManyBehavior;
use krok\extend\behaviors\IpBehavior;
use krok\extend\traits\BlockedAttributeTrait;
use krok\extend\interfaces\BlockedAttributeInterface;
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
 * @property integer $blocked
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property SubscriptionGroup[] $groupRelation
 */
class Subscriber extends \yii\db\ActiveRecord implements BlockedAttributeInterface
{
    use BlockedAttributeTrait;

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
            'IpBehavior' => [
                'class' => IpBehavior::class,
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
            [['blocked'], 'integer'],
            [['createdAt', 'updatedAt', 'country', 'city', 'ip', 'link'], 'safe'],
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
            'ip' => 'Ip адрес',
            'link' => 'Адрес страницы',
            'blocked' => 'Заблокирован',
            'createdAt' => 'Добавлен',
            'updatedAt' => 'Обновлен',
            'groupIDs' => 'Группы рассылок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRelation()
    {
        return $this->hasMany(SubscriptionGroup::class, ['id' => 'groupId'])
            ->viaTable(SubscriptionGroupAssignment::tableName(),
                ['subscriberId' => 'id']);
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
