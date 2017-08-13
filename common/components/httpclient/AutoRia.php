<?php
namespace httpclient;

/**
 * Class AutoRia
 *
 * @package httpclient
 */
class AutoRia extends \yii\httpclient\Client
{
    /**
     * @var string Api key for ria.com API
     */
    public $apiKey;

    /**
     * @inheritdoc
     */
    public function get($url, $data = null, $headers = [], $options = [])
    {
        if (!isset($data['api_key'])) {
            $data['api_key'] = $this->apiKey;
        }

        return parent::get($url, $data, $headers, $options);
    }
}
