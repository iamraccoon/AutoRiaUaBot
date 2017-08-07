<?php
namespace storage;

/**
 * Class Module
 *
 * @package storage
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->defaultRoute = 'import/run';

        parent::init();
    }
}
