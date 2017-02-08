<?php
namespace Weverson83\Correios\Model\Source;

use Magento\TestFramework\ObjectManager;

class MethodListTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAllOptions()
    {
        $ob = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $model = $ob->getObject(\Weverson83\Correios\Model\Config\MethodList::class);
        print_r($model->toOptionArray());
    }
}