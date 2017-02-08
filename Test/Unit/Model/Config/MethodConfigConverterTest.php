<?php
namespace Weverson83\Correios\Model\Config;

use Magento\Framework\Config\ConverterInterface;

class MethodConfigConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MethodConfigConverter
     */
    private $converter;

    protected function setUp()
    {
        $this->converter = new MethodConfigConverter();
    }

    /**
     * @return \DOMDocument
     */
    private function createDOMDocument($xml)
    {
        $source = new \DOMDocument();
        $source->loadXML($xml);
        return $source;
    }

    public function testImplementsTheConfigConverterInterface()
    {
        $this->assertInstanceOf(ConverterInterface::class, $this->converter);
    }

    public function testReturnsArrayForMethodList()
    {
        $expectedArray = [
            'methods' => [
                '88' => 'Test 1',
                '99' => 'Test 2',
            ]
        ];
        $xml = <<<XML
<methods>
    <service value="88" label="Test 1" />
    <service value="99" label="Test 2" />
</methods>
XML;

        $this->assertSame($expectedArray, $this->converter->convert($this->createDOMDocument($xml)));
    }

    public function testReturnsTheRootNode()
    {
        $document = $this->createDOMDocument('<root/>');
        $rootNode = $this->converter->getRootNode($document);

        $this->assertInstanceOf(\DOMElement::class, $rootNode);
        $this->assertSame('root', $rootNode->nodeName);
    }

    public function testReturnsAllChildNodes()
    {
        $xml = <<<XML
<root>
    <child/>
    <child/>
    <child/>
</root>
XML;
        $documentChildren = $this->converter->getAllChildElements($this->createDOMDocument($xml));
        $this->assertInternalType('array', $documentChildren);
        $this->assertCount(1, $documentChildren);
        $this->assertContainsOnlyInstancesOf(\DOMElement::class, $documentChildren);
        $this->assertCount(3, $this->converter->getAllChildElements($documentChildren[0]));
    }
}
