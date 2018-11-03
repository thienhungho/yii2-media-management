<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model thienhungho\MediaManagement\modules\MediaBase\Media */
/* @var $form yii\widgets\ActiveForm */
$model->status = \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PUBLIC;
?>

<div class="row media-form">

    <div class="col-lg-12 col-sm-12">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->errorSummary($model); ?>

        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

        <?= \kartik\file\FileInput::widget([
            'name' => 'gallery[]',
            'options'=>[
                'multiple'=>true
            ],
            'pluginOptions' => [
                'initialPreviewAsData' => true,
                'overwriteInitial' => true,
            ]
        ]);
        ?>

        <div class="form-group">
            <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
                <?= Html::submitButton($model->isNewRecord ? __t('app', 'Create') : __t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?><?php endif; ?>
            <?= Html::a(__t('app', 'Cancel'), request()->referrer, ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
