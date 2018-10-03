<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

class Restaurant extends Dish
{
    public $ingredient_ids;
    public $cnt;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['ingredient_ids'], 'each', 'rule' => ['integer']],
            ['ingredient_ids', 'checkCount']
        ];
    }

    /**
     * Validates the list of ingredient ID.
     * This method serves as the inline validation for ingredient IDs.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function checkCount($attribute, $params)
    {
        if (count($this->ingredient_ids) > 2) {
            return true;
        }

        $this->addError($attribute, 'Выберите больше ингредиентов!');
    }

    /**
     * Search dishes
     *
     * @return array|ActiveRecord[]
     */
    public function searchDishes()
    {
        if ($this->ingredient_ids && $this->validate()) {
            $dishes = self::find()->select([
                'name' => new Expression(Dish::tableName() . '.name'),
                'cnt' => new Expression('count(ingredient_id)')
            ])->joinWith('ingredients')->where([
                'IN',
                Ingredient::tableName() . '.id',
                $this->ingredient_ids
            ])->groupBy('dish_id')->orderBy(['cnt' => SORT_DESC])->all();
            $outDishes = [];
            foreach ($dishes as $dish) {
                if ($dish['cnt'] == count($this->ingredient_ids)) {
                    $outDishes[] = $dish;
                }
            }

            return $outDishes ? $outDishes : $dishes;
        }

        return [];
    }

}
