<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Image', ['upload', 'id'=>$model->product_id], ['class'=>'btn btn-primary'])?>
    </p>

    <?=Html::img('\\images\\products\\'.$model->image, ['class'=>'img-thumbnail', 'style'=>'max-width: 50%'])?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'name',
            'manufacturer_id',
            'short_description',
            'description:ntext',
            'image',
            'price',
        ],
    ]) ?>

</div>
