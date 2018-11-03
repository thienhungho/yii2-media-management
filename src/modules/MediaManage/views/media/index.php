<?php
/* @var $this yii\web\View */
/* @var $searchModel thienhungho\MediaManagement\modules\MediaManage\search\MediaSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = t('app', 'Media');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="media-index-head">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <p>
                <?= Html::a(t('app', 'Create Media'), ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(t('app', 'Create Multiple Media'), ['create-multiple'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
            </p>
        </div>
        <div class="col-lg-2">
            <?php backend_per_page_form() ?>
        </div>
    </div>

    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

</div>

<?= Html::beginForm(['bulk'], 'post', ['id' => 'bulk']) ?>

<div class="media-index">
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['class' => '\kartik\grid\CheckboxColumn'],
        [
            'attribute' => 'id',
            'visible'   => false,
        ],
        [
            'class'     => \yii\grid\DataColumn::className(),
            'format'    => 'raw',
            'attribute' => 'path',
            'value'     => function($model, $key, $index, $column) {
                return Html::a(
                    '<img style="max-width: 100px;" src=/' . \thienhungho\MediaManagement\modules\MediaBase\Media::getOtherSizePath('thumbnail', $model->path) . '>',
                    \yii\helpers\Url::to(['/../../' . $model->path]), [
                    'data-pjax' => '0',
                    'target'    => '_blank',
                ]);
            },
        ],
        [
            'class'     => \yii\grid\DataColumn::className(),
            'format'    => 'raw',
            'attribute' => 'file_size',
            'value'     => function($model, $key, $index, $column) {
                return format_size_units($model->file_size);
            },
        ],
        [
            // this line is optional
            'format'              => 'raw',
            'attribute'           => 'type',
            'value'               => function($model, $key, $index, $column) {
                if ($model->type == 'image/png') {
                    return '<span class="label-warning label">' . 'image/png' . '</span>';
                } elseif ($model->type == 'image/jpeg') {
                    return '<span class="label-success label">' . 'image/jpeg' . '</span>';
                }
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map([
                [
                    'value' => 'image/png',
                    'name'  => 'PNG',
                ],
                [
                    'value' => 'image/jpeg',
                    'name'  => 'JPEG',
                ],
            ], 'value', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions'  => [
                'placeholder' => t('app', 'Status'),
                'id'          => 'grid-search-status',
            ],
        ],
        [
            // this line is optional
            'format'              => 'raw',
            'attribute'           => 'status',
            'value'               => function($model, $key, $index, $column) {
                if ($model->status == \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PENDING) {
                    return '<span class="label-warning label">' . t('app', 'Pending') . '</span>';
                } elseif ($model->status == \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PUBLIC) {
                    return '<span class="label-success label">' . t('app', 'Public') . '</span>';
                } elseif ($model->status == \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_DRAFT) {
                    return '<span class="label-danger label">' . t('app', 'Draft') . '</span>';
                }
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map([
                [
                    'value' => \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PENDING,
                    'name'  => t('app', 'Pending'),
                ],
                [
                    'value' => \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_PUBLIC,
                    'name'  => t('app', 'Public'),
                ],
                [
                    'value' => \thienhungho\MediaManagement\modules\MediaBase\Media::STATUS_DRAFT,
                    'name'  => t('app', 'Draft'),
                ],
            ], 'value', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions'  => [
                'placeholder' => t('app', 'Status'),
                'id'          => 'grid-search-status',
            ],
        ],
    ];
    $activeColumn = grid_view_default_active_column_cofig();
    $activeColumn['buttons']['get-path'] = function($url, $model, $key) {
        return '<a title="' . t('app', 'Get Path') . '" onclick="prompt(\'Media Path: \', \'' . $_SERVER['HTTP_HOST'] . '/' . $model->path . '\' )"><span class="btn btn-xs grey-cascade"><span class="fa fa-link"></span></span></a>';
    };
    $activeColumn['template'] = '{get-path} {save-as-new} {view} {update} {delete}';
    $gridColumn[] = $activeColumn;
    ?>
    <?= GridView::widget([
        'dataProvider'   => $dataProvider,
        'filterModel'    => $searchModel,
        'columns'        => $gridColumn,
        'condensed'      => true,
        'responsiveWrap' => false,
        'hover'          => true,
        'pjax'           => true,
        'pjaxSettings'   => ['options' => ['id' => 'kv-pjax-container-media']],
        'panel'          => [
            'type'    => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar'        => grid_view_toolbar_config($dataProvider, $gridColumn),
    ]); ?>
    <div class="row">
        <div class="col-lg-2">
            <?= \kartik\widgets\Select2::widget([
                'name'    => 'action',
                'value'   => '',
                'data'    => [ACTION_DELETE => t('app', 'Delete')],
                'theme'   => \kartik\widgets\Select2::THEME_BOOTSTRAP,
                'options' => [
                    'multiple'    => false,
                    'placeholder' => t('app', 'Bulk Actions ...'),
                ],
            ]); ?>
        </div>
        <div class="col-lg-10">
            <?= Html::submitButton(t('app', 'Apply'), [
                'class'        => 'btn btn-primary',
                'data-confirm' => t('app', 'Are you want to do this?'),
            ]) ?>
        </div>
    </div>
</div>

<?= Html::endForm() ?>
