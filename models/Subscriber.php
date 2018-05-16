<?php

namespace tina\subscriber\models;

use krok\extend\behaviors\TimestampBehavior;
use tina\subscriber\interfaces\ActiveAttributeInterface;
use tina\subscriber\traits\ActiveAttributeTrait;
use voskobovich\behaviors\ManyToManyBehavior;
use krok\extend\behaviors\IpBehavior;
use tina\subscriber\behaviors\TokenBehavior;
use krok\extend\traits\BlockedAttributeTrait;
use krok\extend\interfaces\BlockedAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;
use krok\extend\interfaces\HiddenAttributeInterface;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "{{%subscriber}}".
 *
 * @property integer $id
 * @property string $email
 * @property string $country
 * @property string $city
 * @property string $coordinates
 * @property integer $ip
 * @property string $link
 * @property integer $blocked
 * @property integer $active
 * @property string $token
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property SubscriptionGroup[] $groupRelation
 */
class Subscriber extends \yii\db\ActiveRecord implements BlockedAttributeInterface, HiddenAttributeInterface, ActiveAttributeInterface
{
    use BlockedAttributeTrait;
    use HiddenAttributeTrait;
    use ActiveAttributeTrait;

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
            'TokenBehavior' => [
                'class' => TokenBehavior::class,
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
            [['blocked', 'active'], 'integer'],
            [['createdAt', 'updatedAt', 'country', 'city', 'coordinates', 'ip', 'link', 'token'], 'safe'],
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
            'coordinates' => 'Координаты',
            'ip' => 'Ip адрес',
            'link' => 'Адрес страницы',
            'blocked' => 'Заблокирован',
            'active' => 'Активный',
            'token' => 'Токен',
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
     * formats E-mail message and sends it to subscriber
     */
    public function notifications()
    {
        $message = Yii::$app->mailer->compose('@app/extensions/subscriber/mail/form', ['model' => $this]);
        $message
            ->setFrom(Yii::$app->params['email'])
            ->setTo($this->email)
            ->setSubject('Сообщение с сайта ЭНСАЙН')
            ->send();
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
