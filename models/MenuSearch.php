<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02.05.17
 * Time: 16:40
 */

namespace sirgalas\menu\models;

use sirgalas\menu\models\Menu;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MenuSearch extends Menu
{
    public function rules()
    {
        $module=$this->module;
        if(empty($module->modelDb)){
            return [
                [['name'], 'safe'],
            ];
        }else{
            return[
                [[$module->modelDb->name],'safe'],
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = Menu::find()->where(["key_setup"=>"lines"]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $module=$this->module;
        if(empty($module->modelDb)) {
            $query->andFilterWhere(['like', 'name', $this->name]);
        }else{
            $query->andFilterWhere(['like', $module->modelDb->name, $this->name]);
        }
        return $dataProvider;
    }
}