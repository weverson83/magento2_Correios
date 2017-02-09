<?php
/**
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @author    Weverson Cachinsky <weversoncachinsky@gmail.com>
 */
namespace Weverson\Correios\Model\Method;

class Method
{
    /** @var string */
    private $code;

    /** @var string */
    private $label;

    /** @var float */
    private $maxWeight;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return float
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * @param float $maxWeight
     * @return self
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;

        return $this;
    }
}
