<?php
namespace search\controllers;

use search\components\Search;

/**
 * Class SearchController
 *
 * @package search\controllers
 */
class SearchController extends \yii\console\Controller
{
    /**
     * @var Search
     */
    private $search;

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $this->search = new Search();

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

    public function actionExecute()
    {
        $this->search->entityIds();
    }

    public function actionInfo()
    {
        $this->search->entityInfo();
    }
}
