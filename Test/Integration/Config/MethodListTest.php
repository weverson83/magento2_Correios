<?php
/**
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @author    Weverson Cachinsky <weversoncachinsky@gmail.com>
 */
namespace Weverson83\Correios;

use Magento\Framework\ObjectManager\ConfigInterface as ObjectManagerConfig;
use Magento\TestFramework\ObjectManager;

class MethodListTest extends \PHPUnit_Framework_TestCase
{
    private $configType = Model\Config\MethodList::class;

    private $readerType = Model\Config\MethodList\Reader::class;

    private $schemaLocatorType = Model\Config\MethodList\SchemaLocator::class;

    private $converterType = Model\Config\MethodConfigConverter::class;


    /**
     * @return ObjectManagerConfig
     */
    private function getDiConfig()
    {
        return ObjectManager::getInstance()->get(ObjectManagerConfig::class);
    }

    /**
     * @param string $expectedType
     * @param string $type
     */
    private function assertVirtualType($expectedType, $type)
    {
        $this->assertSame($expectedType, $this->getDiConfig()->getInstanceType($type));
    }

    /**
     * @param string $expected
     * @param string $type
     * @param string $argumentName
     */
    private function assertDiArgumentSame($expected, $type, $argumentName)
    {
        $arguments = $this->getDiConfig()->getArguments($type);
        if (!isset($arguments[$argumentName])) {
            $this->fail(sprintf('No argument "%s" configured for %s', $argumentName, $type));
        }
        $this->assertSame($expected, $arguments[$argumentName]);
    }

    /**
     * @param string $expectedType
     * @param string $type
     * @param string $argumentName
     */
    private function assertDiArgumentInstance($expectedType, $type, $argumentName)
    {
        $arguments = $this->getDiConfig()->getArguments($type);
        if (!isset($arguments[$argumentName])) {
            $this->fail(sprintf('No argument "%s" configured for %s', $argumentName, $type));
        }
        if (!isset($arguments[$argumentName]['instance'])) {
            $this->fail(sprintf('The argument "%s" for %s is not of xsi:type="object"', $argumentName, $type));
        }
        $this->assertSame($expectedType, $arguments[$argumentName]['instance']);
    }

    public function testVirtualType()
    {
        $this->assertVirtualType(\Magento\Framework\Config\Data::class, $this->configType);
        $this->assertDiArgumentSame('weverson83_correios_method_list', $this->configType, 'cacheId');
        $this->assertDiArgumentInstance($this->readerType, $this->configType, 'reader');
    }

    public function testConfigReaderDiConfig()
    {
        $this->assertVirtualType(\Magento\Framework\Config\Reader\Filesystem::class, $this->readerType);
        $this->assertDiArgumentSame('methods_config.xml', $this->readerType, 'fileName');
        $this->assertDiArgumentInstance($this->schemaLocatorType, $this->readerType, 'schemaLocator');
    }

    public function testConfigSchemaLocatorDiConfig()
    {
        $this->assertVirtualType(\Magento\Framework\Config\GenericSchemaLocator::class, $this->schemaLocatorType);
        $this->assertDiArgumentSame('Weverson83_Correios', $this->schemaLocatorType, 'moduleName');
        $this->assertDiArgumentSame('methods_config.xsd', $this->schemaLocatorType, 'schema');
    }

    public function testConfigConverterDiConfig()
    {
        $this->assertDiArgumentInstance($this->converterType, $this->readerType, 'converter');
    }

    public function testCanReadXmlData()
    {
        /** @var \Magento\Framework\Config\DataInterface $config */
        $config = ObjectManager::getInstance()->create($this->configType);
        $data = $config->get(null);
        $this->assertNotEmpty($data);
    }

    public function testCanAccessMethodConfig()
    {
        $objectManager = ObjectManager::getInstance();
        /** @var \Magento\Framework\Config\Data $config */
        $config = $objectManager->create($this->configType);
        $this->assertNotEmpty($config->get('methods'));
    }
}
