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
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model); ?>

        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

        <?= $form->field($model, 'status', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-eye"></span>']],
        ])->radioButtonGroup([
            \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PUBLIC  => __t('app', 'Public'),
            \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PENDING => __t('app', 'Pending'),
            \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_DRAFT   => __t('app', 'Draft'),
        ], [
            'class' => 'btn-group-sm',
            'itemOptions' => ['labelOptions' => ['class' => 'btn green']]
        ]); ?>

        <?= $form->field($model, 'title', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => __t('app', 'Title'),
        ]) ?>

        <?= $form->field($model, 'caption', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => __t('app', 'Caption'),
        ]) ?>

        <?= $form->field($model, 'alt', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => __t('app', 'Alt'),
        ]) ?>

        <?= $form->field($model, 'description', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => __t('app', 'Description'),
        ]) ?>

        <?= $form->field($model, 'path')->fileInput()
            ->widget(\kartik\file\FileInput::classname(), [
                'options'       => ['accept' => 'image/*'],
                'pluginOptions' => empty($model->path) ? [] : [
                    'initialPreview'       => [
                        '/' . $model->path,
                    ],
                    'initialPreviewAsData' => true,
                    'initialCaption'       => $model->path,
                    'overwriteInitial'     => true,
                ],
            ])->label(__t('app', 'Media'));
        ?>

        <div class="form-group">
            <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
                <?= Html::submitButton($model->isNewRecord ? __t('app', 'Create') : __t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?><?php endif; ?>
            <?= Html::a(__t('app', 'Cancel'), request()->referrer, ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
