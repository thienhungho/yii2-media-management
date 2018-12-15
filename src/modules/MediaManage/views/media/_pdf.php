<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use thienhungho\Widgets\models\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\MediaManagement\modules\MediaBase\Media */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => t('app', 'Media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= t('app', 'Media').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'path',
        'title',
        'caption',
        'alt',
        'description',
        'file_size',
        'dimensions',
        'type',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
