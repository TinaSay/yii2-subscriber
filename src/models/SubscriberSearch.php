<?php

namespace tina\subscriber\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SubscriberSearch represents the model behind the search form about `tina\subscriber\models\Subscriber`.
 */
class SubscriberSearch extends Subscriber
{
    /**
     * @var int
     */
    public $groupIds;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'groupIds', 'blocked', 'active'], 'integer'],
            [['email', 'country', 'city', 'ip', 'link', 'createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Subscriber::find()->joinWith('groupsRelation');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            Subscriber::tableName() . '.[[id]]' => $this->id,
            SubscriptionGroup::tableName() . '.[[id]]' => $this->groupIds,
            Subscriber::tableName() . '.[[blocked]]' => $this->blocked,
            Subscriber::tableName() . '.[[active]]' => $this->active,
        ]);

        $query
            ->andFilterWhere(['like', Subscriber::tableName() . '.[[email]]', $this->email])
            ->andFilterWhere(['like', Subscriber::tableName() . '.[[country]]', $this->country])
            ->andFilterWhere(['like', Subscriber::tableName() . '.[[city]]', $this->city])
            ->andFilterWhere(['like', Subscriber::tableName() . '.[[ip]]', $this->ip ? ip2long($this->ip) : null])
            ->andFilterWhere(['like', Subscriber::tableName() . '.[[link]]', $this->link])
            ->andFilterWhere(['like', Subscriber::tableName() . '.[[createdAt]]', $this->createdAt])
            ->andFilterWhere(['like', Subscriber::tableName() . '.[[updatedAt]]', $this->updatedAt]);

        return $dataProvider;
    }
}
