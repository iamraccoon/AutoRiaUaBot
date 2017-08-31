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
     * @const int Per page
     */
    const COUNT_PAGE = 100;

    /**
     * @const int Period Id
     */
    const PERIOD = 1;

    /**
     * @const int Default category id
     */
    const CAR_CATEGORY_ID = 1;

    /**
     * @const string Search url
     */
    const SEARCH_URL = 'search';

    /**
     * @var string Api key for ria.com API
     */
    public $apiKey;

    /**
     * @inheritdoc
     */
    public function get($url, $data = null, $headers = [], $options = [])
    {
        if (empty($data['api_key'])) {
            $data['api_key'] = $this->apiKey;
        }

        return parent::get($url, $data, $headers, $options);
    }

    /**
     * @inheritdoc
     */
    public function searchEntityIds($url = '', $data = null, $headers = [], $options = [])
    {
        if (empty($url)) {
            $url = self::SEARCH_URL;
        }
        if (empty($data['category_id'])) {
            $data['category_id'] = self::CAR_CATEGORY_ID;
        }
        if (empty($data['countpage'])) {
            $data['countpage'] = self::COUNT_PAGE;
        }
        if (empty($data['top'])) {
            $data['top'] = self::PERIOD;
        }

        return $this->get($url, $data, $headers, $options);
    }
}
