<?php

namespace tina\subscriber\models;

use krok\extend\behaviors\LanguageBehavior;
use krok\extend\behaviors\TimestampBehavior;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%subscription_group}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $hidden
 * @property string $language
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Subscriber subscriber[]
 */
class SubscriptionGroup extends \yii\db\ActiveRecord implements HiddenAttributeInterface
{
    use HiddenAttributeTrait;

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
            'LanguageBehavior' => [
                'class' => LanguageBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subscription_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['hidden'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 64],
            [['title'], 'unique', 'targetAttribute' => ['title', 'language']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'hidden' => 'Скрыто',
            'createdAt' => 'Добавлена',
            'updatedAt' => 'Обновлена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscribers()
    {
        return $this->hasMany(Subscriber::class, ['id' => 'subscriberId'])
            ->viaTable(SubscriptionGroupAssignment::tableName(), ['groupId' => 'id']);
    }

    /**
     * @return array
     */
    public static function asDropDown()
    {
        return ArrayHelper::map(self::find()->where([
            'hidden' => self::HIDDEN_NO,
        ])->language()->all(), 'id', 'title');
    }

    /**
     * @inheritdoc
     * @return SubscriptionGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionGroupQuery(get_called_class());
    }
}
