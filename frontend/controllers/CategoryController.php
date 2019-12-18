<?php


namespace frontend\controllers;


use frontend\models\Category;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $category = Category::find()->where(['parent_id' => 0])->all();

        return $this->render('index', ['categories' => $category]);
    }

    public function actionView($id = 0)
    {
//        $categories = Category::find()->where(['parent_id' => $id])->all();
        $nextCategoriesLevel = Category::find()->where(['parent_id' => $id])->all();
        $currentCategory = Category::find()->where(['category_id' => $id])->one();

//        $productsQuery = new \yii\db\Query();
//        $products = $productsQuery
//            ->select(['product.*'])
//            ->from('category_product')
//            ->join('LEFT JOIN', 'product', 'product.product_id = category_product.product_id')
//            ->where(['category_product.category_id' => $id]);
        $prevCategoriesLevel = Category::find()->where(['parent_id' => $currentCategory['parent_id']])->all();

//        $pagination = new Pagination(['totalCount' => $products->count()]);

//        $products = $products->offset($pagination->offset)->limit($pagination->limit)->all();

        $allCategoriesQuery = new \yii\db\Query();
        $allCategories = $allCategoriesQuery
            ->select('name, category_id, parent_id')
            ->from('category')
            ->all();

        $breadcrumbs = [];
        $breadcrumbs[] = [
            'name' => $currentCategory['name'],
            'path' => '/category/view?id=' . $currentCategory['category_id']
        ];
        $isBreadBuildFinish = false;
        $selectedCategoryLoop = &$currentCategory;
        while (!$isBreadBuildFinish) {
            foreach ($allCategories as $category) {
                if ($category['category_id'] == $selectedCategoryLoop['parent_id']) {
                    $selectedCategoryLoop = &$category;
                    array_unshift($breadcrumbs, [
                        'name' => $selectedCategoryLoop['name'],
                        'path' => '/category/view?id=' . $selectedCategoryLoop['category_id']
                    ]);
                    break;
                }
            }
            if ($selectedCategoryLoop['parent_id'] == 0)
                $isBreadBuildFinish = true;
        }

        return $this->render('view',
            compact('nextCategoriesLevel', 'breadcrumbs', 'currentCategory', 'prevCategoriesLevel' /*, 'products', 'pagination'*/)
        );
    }
}