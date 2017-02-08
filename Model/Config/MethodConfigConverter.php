<?php
namespace Weverson83\Correios\Model\Config;

use Magento\Framework\Config\ConverterInterface;

class MethodConfigConverter implements ConverterInterface
{
    /**
     * Convert config
     *
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $rootNode = $this->getRootNode($source);
        $result = [];
        foreach ($this->getAllChildElements($rootNode) as $childNode) {
            if ($childNode->nodeName === 'service') {
                $serviceCode = $childNode->attributes->getNamedItem('value')->nodeValue;
                $result[$serviceCode] = $childNode->attributes->getNamedItem('label')->nodeValue;
            }
        }
        return [$rootNode->nodeName => $result];
    }

    public function getRootNode(\DOMDocument $document)
    {
        return $this->getAllChildElements($document)[0];
    }

    /**
     * @param \DOMNode $source
     * @return \DOMElement[]
     */
    public function getAllChildElements(\DOMNode $source)
    {
        return array_filter(iterator_to_array($source->childNodes), function (\DOMNode $childNode) {
            return $childNode->nodeType === \XML_ELEMENT_NODE;
        });
    }
}
 