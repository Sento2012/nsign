<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

class Ingredient extends ActiveRecord
{

    const STATUS_SHOW = 0;
    const STATUS_HIDDEN = 1;

    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 150],
            [['hidden'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Search all ingredient
     *
     * @param string $keyField - array key
     * @param string $valueField - array value
     * @param bool $asArray - is array
     * @return array
     */
    public static function listAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = static::find();
        $query->where(['hidden' => self::STATUS_SHOW]);
        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }

}
