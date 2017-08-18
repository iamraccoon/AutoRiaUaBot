<?php
namespace glossary\components\traits;

use httpclient\AutoRia;

/**
 * Trait RequestsTrait
 *
 * @package glossary\components\traits
 */
trait RequestsTrait
{
    /**
     * @var int Category of car
     */
    private $carCategory = 1;

    /**
     * Map of requests
     *
     * @return array
     */
    public function requestsMap()
    {
        return [
            'glossaryState' => 'states',
            'glossaryCity' => [
                'url' => 'states/:ID/cities',
                'dependency' => 'glossaryState'
            ],
            'glossaryColor' => 'colors',
            'glossaryFuel' => 'type',
            'glossaryBodyStyle' => 'categories/' . $this->carCategory . '/bodystyles',
            'glossaryBrand' => 'categories/' . $this->carCategory . '/marks',
            'glossaryOption' => 'categories/' . $this->carCategory . '/options',
            'glossaryTransmission' => 'categories/' . $this->carCategory . '/gearboxes',
            'glossaryModel' => [
                'url' => 'categories/' . $this->carCategory . '/marks/:ID/models/_group',
                'dependency' => 'glossaryBrand'
            ]
        ];
    }

    /**
     * Get request urls
     *
     * @param AutoRia $client Http-client
     * @param array $glossaryRepository Repository
     *
     * @return array
     */
    public function getRequestUrls(AutoRia $client, $glossaryRepository)
    {
        $requests = [];
        foreach ($this->requestsMap() as $glossary => $url) {
            if (is_array($url)) {
                if (empty($url['url']) || empty($url['dependency'])) {
                    continue;
                }
                $urls = $this->prepareDependencyUrl($url['dependency'], $url['url'], $glossaryRepository);
                foreach ($urls as $id => $curUrl) {
                    $requests['dependent'][$glossary][$id] = $client->get($curUrl);
                }
            } else {
                $requests[$glossary] = $client->get($url);
            }
        }

        return $requests;
    }

    /**
     * Prepare dependency url
     *
     * @param string $dependency Name of dependency
     * @param string $url Url
     * @param array $glossaryRepository Repository
     *
     * @return array
     */
    private function prepareDependencyUrl($dependency, $url, $glossaryRepository)
    {
        if (empty($glossaryRepository[$dependency])) {
            return [];
        }

        $urls = [];
        foreach ($glossaryRepository[$dependency] as $id => $val) {
            $urls[$id][] = preg_replace('/:ID/', $id, $url);
        }

        return $urls;
    }
}
