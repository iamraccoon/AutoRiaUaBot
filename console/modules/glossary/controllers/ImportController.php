<?php
namespace glossary\controllers;

use glossary\components\Import;

/**
 * Class ImportController
 *
 * @package glossary\controllers
 */
class ImportController extends \yii\console\Controller
{
    /**
     * Execute glossary import
     */
    public function actionExecute()
    {
        try {
            (new Import())->import();
        } catch (\Exception $e) {
            // TODO send email
        }
    }
}
