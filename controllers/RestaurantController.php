<?php

namespace app\controllers;

use app\models\Restaurant;
use Yii;
use app\models\Dish;
use app\models\DishSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestaurantController
 */
class RestaurantController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Restaurant();
        $dishes = [];
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $dishes = $model->searchDishes();
        }

        return $this->render('index', [
            'model' => $model,
            'dishes' => $dishes
        ]);
    }

}
