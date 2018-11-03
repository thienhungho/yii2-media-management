<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model thienhungho\MediaManagement\modules\media\Media */

$this->title = __t('app', 'Create Media');
$this->params['breadcrumbs'][] = ['label' => __t('app', 'Media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
    ]) ?>

</div>
