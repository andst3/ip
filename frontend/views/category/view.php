<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var $_products  array */
/** @var $_pagination mixed */
/** @var $_categories array */
/** @var $breadcrumbs array */
/** @var $prevCategoriesLevel array */
/** @var $nextCategoriesLevel array */
/** @var $currentCategory array */

$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['category/index']];
foreach ($breadcrumbs as $bread)
    $this->params['breadcrumbs'][] =
        ['label' => $bread['name'], 'url' => Html::encode($bread['path'])];
?>

<div class="container">
    <div class="row">
        <div class="col-3 col-md-3 col-lg-3">
            <ul class="list-group">
                <li class="list-group-item active">Категорії</li>
                <?php foreach ($prevCategoriesLevel as $prev): ?>
                    <li class="list-group-item">
                        <?= Html::a(
                            $prev['name'],
                            ['/category/view', 'id' => $prev['category_id']]
                        ) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-9 col-md-9 col-lg-9">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <h1><?= Html::encode($currentCategory['name']) ?></h1>
                    <p><?= Html::encode($currentCategory['description']) ?></p>
                </div>
            </div>

            <div class="row">
                <?php foreach ($nextCategoriesLevel as $next) : ?>
                    <div class="col-4 col-md-4 col-lg-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <?= Html::a(
                                    $next['name'],
                                    ['/category/view', 'id' => $next['category_id']],
                                    ['style' => 'color: white']
                                ) ?>
                            </div>
                            <div class="panel-body" style="max-height: 200px; overflow-y: hidden">
                                <? //= Html::encode($next['description']) ?>
                                <?php
                                $imgPath = \Yii::getAlias('@web') . '/images/categories/' . strtolower($next['image']);
                                $imgStyle = "width: 100%; height: 10vw; object-position: center; object-fit: cover;";
                                ?>
                                <?php if (file_exists($imgPath)): ?>
                                    <?= Html::img(
                                        $imgPath . strtolower($next['image']),
                                        ['alt' => $next['name'], 'class' => 'card-img-top', 'style' => $imgStyle]
                                    ) ?>
                                <?php else: ?>
                                    <?= Html::img(
                                        '@web/images/placeholder.jpg',
                                        ['alt' => 'placeholder', 'class' => 'card-img-top', 'style' => $imgStyle]
                                    ) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<? //= LinkPager::widget(['pagination' => $pagination]) ?>


