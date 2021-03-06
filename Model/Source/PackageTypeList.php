<?php
/**
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @author    Weverson Cachinsky <weversoncachinsky@gmail.com>
 */
namespace Weverson\Correios\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class PackageTypeList implements ArrayInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => 'Caixa/Pacote'],
            ['value' => '2', 'label' => 'Rolo/Prisma'],
            ['value' => '3', 'label' => 'Envelope'],
        ];
    }
}
