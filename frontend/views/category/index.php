<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $categories array */
?>
<h1>Категорії</h1>
<div class="container">
    <div class="row">

        <?php foreach ($categories as $category) : ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?= Html::a(
                            $category['name'],
                            ['/category/view', 'id' => $category['category_id']],
                            ['style' => 'color: white']
                        ) ?>
                    </div>
                    <div class="panel-body">
                        <?= Html::img(
                            "@web/images/categories/" . strtolower($category['image']),
                            ['alt' => $category['name'], 'class' => 'card-img-top', 'style' => "width: 100%"]
                        ) ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>