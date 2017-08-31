<?php
namespace search\components;

use httpclient\AutoRia;

class Search extends \yii\base\Object
{
    /**
     * @var AutoRia Client
     */
    private $client;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->client = \Yii::$app->autoRia;

        parent::init();
    }

    public function entityIds()
    {
        $res = $this->client->searchEntityIds();
        print_r($res);

        $cache = \Yii::$app->cache;
        $key   = 'new';
        $data  = $cache->get($key);
        if ($data === false) {
            $data = 'A newly cache added ' . rand();
            $cache->set($key, $data);
        }

        echo $data;

        echo '___________***';
        exit;
    }

    public function entityInfo()
    {

    }
}