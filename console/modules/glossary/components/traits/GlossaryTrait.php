<?php
namespace glossary\components\traits;

/**
 * Trait GlossaryTrait
 *
 * @package glossary\components\traits
 */
trait GlossaryTrait
{
    use RequestsTrait;

    /**
     * @var string Namespace of glossary models
     */
    private $glossaryNamespace = 'models\\glossary\\';

    /**
     * Get glossary data
     *
     * @return array
     */
    public function getGlossaryData()
    {
        $glossaryData = [];

        $models = array_keys($this->requestsMap());
        foreach ($models as $model) {
            $glossaryModel = $this->glossaryNamespace . ucfirst($model);
            $glossaryData[$model] = (new $glossaryModel)->getGlossaryData();
        }

        return $glossaryData;
    }
}
