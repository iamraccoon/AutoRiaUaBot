<?php
namespace glossary;

/**
 * Class Module
 *
 * @package glossary
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->defaultRoute = 'import/execute';

        parent::init();
    }
}
