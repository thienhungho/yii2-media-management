<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Site Configuration') . ' - ' . Yii::t('app', 'Media');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Site Configuration'),
    'url'   => ['/site-configuration'],
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Media');
?>

<div class="row">
    <?php $form = ActiveForm::begin(['id' => 'media-form']); ?>

    <div class="col-lg-6">
        <?= $form->field($model, 'thumbnail_size_width', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-arrows-h"></span>']],
        ])->textInput(['type' => 'number']); ?>
    </div>

    <div class="col-lg-6">
        <?= $form->field($model, 'thumbnail_size_height', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-arrows-v"></span>']],
        ])->textInput(['type' => 'number']); ?>
    </div>

    <div class="col-lg-6">
        <?= $form->field($model, 'medium_size_width', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-arrows-h"></span>']],
        ])->textInput(['type' => 'number']); ?>
    </div>

    <div class="col-lg-6">
        <?= $form->field($model, 'medium_size_height', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-arrows-v"></span>']],
        ])->textInput(['type' => 'number']); ?>
    </div>

    <div class="col-lg-6">
        <?= $form->field($model, 'large_size_width', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-arrows-h"></span>']],
        ])->textInput(['type' => 'number']); ?>
    </div>

    <div class="col-lg-6">
        <?= $form->field($model, 'large_size_height', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-arrows-v"></span>']],
        ])->textInput(['type' => 'number']); ?>
    </div>

    <div class="col-lg-12">
        <?= $form->field($model, 'quality')->widget(\kartik\slider\Slider::className(), [
            'pluginOptions'=>[
                'min' => 10,
                'max' => 99,
                'step' => 1,
                'tooltip'=>'always',
                'formatter'=>new yii\web\JsExpression("function(val) { 
                    if (val < 20) {
                        return 'Low capacity';
                    }
                    if (val < 40) {
                        return 'Good for storage';
                    }
                    if (val < 60) {
                        return 'Medium';
                    }
                    if (val <= 80) {
                        return 'Good';
                    }
                    if (val <= 90) {
                        return 'High';
                    }
                    if (val == 99) {
                        return 'Raw';
                    }
                }")
            ]
        ]); ?>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), [
                'class' => 'btn green',
                'name'  => 'save-button',
            ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>