<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model thienhungho\MediaManagement\modules\MediaManage\search\MediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-media-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => true, 'placeholder' => 'Path']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>

    <?= $form->field($model, 'caption')->textInput(['maxlength' => true, 'placeholder' => 'Caption']) ?>

    <?php /* echo $form->field($model, 'alt')->textInput(['maxlength' => true, 'placeholder' => 'Alt']) */ ?>

    <?php /* echo $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) */ ?>

    <?php /* echo $form->field($model, 'file_size')->textInput(['placeholder' => 'File Size']) */ ?>

    <?php /* echo $form->field($model, 'dimensions')->textInput(['maxlength' => true, 'placeholder' => 'Dimensions']) */ ?>

    <?php /* echo $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => 'Type']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) */ ?>

    <div class="form-group">
        <?= Html::submitButton(__t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(__t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
