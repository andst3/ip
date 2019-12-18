<?php


namespace common\rbac;

use yii\rbac\Rule;
use backend\models\Product;

class ManagerRule extends Rule
{
    public $name = 'isManager';
    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['product']) ? $params['product']->createdBy == $user : false;
    }
}