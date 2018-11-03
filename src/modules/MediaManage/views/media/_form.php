<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model thienhungho\MediaManagement\modules\MediaBase\Media */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row media-form">
    <div class="col-lg-6 col-sm-12" style="background-image: linear-gradient(45deg,#c4c4c4 25%,transparent 25%,transparent 75%,#c4c4c4 75%,#c4c4c4),linear-gradient(45deg,#c4c4c4 25%,transparent 25%,transparent 75%,#c4c4c4 75%,#c4c4c4);
    background-position: 0 0,10px 10px;background-size: 20px 20px;text-align: center;">
        <?php
        if (Yii::$app->controller->action->id == 'update') {
            echo Html::img('/' . $model->path, ['style' => 'border: 1px solid black; margin: 50px 0; max-width: 100%']);
        }
        ?>
    </div>

    <div class="col-lg-6 col-sm-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model); ?>

        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

        <?= $form->field($model, 'status', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-eye"></span>']],
        ])->radioButtonGroup([
            \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PUBLIC  => t('app', 'Public'),
            \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PENDING => t('app', 'Pending'),
            \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_DRAFT   => t('app', 'Draft'),
        ], [
            'class' => 'btn-group-sm',
            'itemOptions' => ['labelOptions' => ['class' => 'btn green']]
        ]); ?>

        <?= $form->field($model, 'name', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'readonly' => true,
            'placeholder' => t('app', 'Name'),
        ]) ?>

        <?= $form->field($model, 'path', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-link"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'readonly' => true,
            'placeholder' => t('app', 'Path'),
        ]) ?>

        <?= $form->field($model, 'file_size', [
            'addon' => ['prepend' => ['content' => 'KB']],
        ])->textInput([
            'maxlength'   => true,
            'readonly' => true,
            'placeholder' => t('app', 'File Size'),
        ]) ?>

        <?= $form->field($model, 'dimensions', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-arrows"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'readonly' => true,
            'placeholder' => t('app', 'File Size'),
        ]) ?>

        <?= $form->field($model, 'type', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-file"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'readonly' => true,
            'placeholder' => t('app', 'Type'),
        ]) ?>

        <?= $form->field($model, 'title', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Title'),
        ]) ?>

        <?= $form->field($model, 'caption', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Caption'),
        ]) ?>

        <?= $form->field($model, 'alt', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Alt'),
        ]) ?>

        <?= $form->field($model, 'description', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Description'),
        ]) ?>

        <div class="form-group">
            <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
                <?= Html::submitButton($model->isNewRecord ? t('app', 'Create') : t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?><?php endif; ?>
            <?= Html::a(t('app', 'Cancel'), request()->referrer, ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
