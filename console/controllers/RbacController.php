<?php


namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // add "viewCategoryProducts" permission
        $viewCategoryProducts = $auth->createPermission('viewCategoryProducts');
        $viewCategoryProducts->description = 'View products and categories';
        $auth->add($viewCategoryProducts);

        // add "viewManufactures" permission
        $viewManufactures = $auth->createPermission('viewManufactures');
        $viewManufactures->description = 'View manufactures';
        $auth->add($viewManufactures);

        // add "addProducts" permission
        $addProducts = $auth->createPermission('addProducts');
        $addProducts->description = 'Add products';
        $auth->add($addProducts);

        // add "changeAllProducts" permission
        $changeAllProducts = $auth->createPermission('changeAllProducts');
        $changeAllProducts->description = 'Change all products';
        $auth->add($changeAllProducts);

        // add "addChangeCategories" permission
        $addChangeCategories = $auth->createPermission('addChangeCategories');
        $addChangeCategories->description = 'Add or change categories';
        $auth->add($addChangeCategories);

        // add "changeManufactures" permission
        $changeManufactures = $auth->createPermission('changeManufactures');
        $changeManufactures->description = 'Change manufactures';
        $auth->add($changeManufactures);
        
        // add "superDelete" permission
        $superDelete = $auth->createPermission('superDelete');
        $superDelete->description = 'Delete products catecories manufactures';
        $auth->add($superDelete);

        // add "authUser" role and give this role the "viewCategoryProducts" permission
        $authUser = $auth->createRole('authUser');
        $auth->add($authUser);
        $auth->addChild($authUser, $viewCategoryProducts);

        // add "manager" role
        // as well as the permissions of the "authUser" role
        $manager = $auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($manager, $authUser);
        $auth->addChild($manager, $addProducts);

        // add "admin" role
        // as well as the permissions of the "authUser" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $addChangeCategories);
        $auth->addChild($admin, $changeManufactures);
        $auth->addChild($admin, $changeAllProducts);

        // add "admin" role
        // as well as the permissions of the "authUser" role
        $superAdmin = $auth->createRole('superAdmin');
        $auth->add($superAdmin);
        $auth->addChild($superAdmin, $admin);
        $auth->addChild($superAdmin, $superDelete);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($superAdmin, 5); // Jane
        $auth->assign($admin, 6); // John
        $auth->assign($manager, 7); // Alex
        $auth->assign($authUser, 8); // Peter


        $auth = Yii::$app->authManager;

        // add the rule
        $rule = new \common\rbac\ManagerRule();
        $auth->add($rule);

        // add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateOwnPost, $changeAllProducts);

        // allow "author" to update their own posts
        $auth->addChild($manager, $updateOwnPost);
    }
}