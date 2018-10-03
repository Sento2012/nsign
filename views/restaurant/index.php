<?php

use app\models\Ingredient;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingredient_ids')->dropDownList(Ingredient::listAll(), ['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php if ($dishes) { ?>
        Список найденных блюд :<br>
        <?php foreach ($dishes as $dish) { ?>
            <?= $dish->name; ?><br>
        <?php } ?>
    <?php } ?>

</div>
