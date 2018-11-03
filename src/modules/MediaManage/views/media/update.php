<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model thienhungho\MediaManagement\modules\MediaBase\Media */

$this->title = t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Media',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => t('app', 'Media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = t('app', 'Update');
?>
<div class="media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
