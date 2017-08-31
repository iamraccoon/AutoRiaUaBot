<?php
namespace search;

/**
 * Class Module
 *
 * @package search
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->defaultRoute = 'search/execute';

        parent::init();
    }
}
