<?php
namespace glossary\components;

use glossary\components\traits\GlossaryTrait;
use httpclient\AutoRia;
use yii\base\Object;
use yii\helpers\Json;

/**
 * Class Import
 *
 * @package glossary\components
 */
class Import extends Object
{
    use GlossaryTrait;

    /**
     * @var AutoRia Client
     */
    private $client;

    /**
     * @var array Requests
     */
    private $requests;

    /**
     * @var array Requests dependent from another glossary
     */
    private $requestsDependent;

    /**
     * @var array Repository of glossary
     */
    private $glossaryRepository;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->client = \Yii::$app->autoRia;
        $this->glossaryRepository = $this->getGlossaryData();
        $this->requests = $this->getRequestUrls($this->client, $this->glossaryRepository);
        if (!empty($this->requests['dependent'])) {
            $this->requestsDependent = $this->requests['dependent'];
            unset($this->requests['dependent']);
        }

        parent::init();
    }

    /**
     * Import glossary data from ria API
     */
    public function import()
    {
        $responsesList = $this->client->batchSend($this->requests);
        foreach ($responsesList as $glossary => $response) {
            if ($response->isOk) {
                $this->ensureGlossaryData($glossary, Json::decode($response->content));
            }
        }

        foreach ($this->requestsDependent as $glossary => $requests) {
            foreach ($requests as $id => $request) {
                $response = $this->client->send($request);
                if ($response->isOk) {
                    $this->ensureGlossaryData($glossary, Json::decode($response->content), $id);
                }
            }
        }
    }

    /**
     * Ensure glossary data
     *
     * @param string $glossary Name of glossary
     * @param array $data Data
     * @param int|null $dependentId Dependent id
     *
     * @return bool
     */
    private function ensureGlossaryData($glossary, array $data, $dependentId = null)
    {
        $repository = $this->glossaryRepository[$glossary] ?? null;
        if ($repository === null) {
            return false;
        }

        $glossaryModel = $this->glossaryNamespace . ucfirst($glossary);
        $model = new $glossaryModel;
        $batchInsertData = $model->makeBatchInsertData($data, $repository, $dependentId);

        if (!empty($batchInsertData)) {
            \Yii::$app->getDb()->createCommand()
                ->batchInsert($glossary, array_keys($model->getAttributes()), $batchInsertData)
                ->execute();

            return true;
        }

        return false;
    }
}
