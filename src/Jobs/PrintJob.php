<?php


namespace Continuity\PrintManager\Jobs;


use Continuity\PrintManager\ContentInterface;
use Continuity\PrintManager\PrintJobInterface;

class PrintJob
    implements PrintJobInterface
{
    /** @var int */
    private $_quantity = 1;

    /** @var bool */
    private $_color = false;

    /** @var bool */
    private $_duplex = false;

    /** @var string|ContentInterface|null */
    private $_content;

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->_quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->_quantity = $quantity;
    }

    /**
     * @return bool
     */
    public function isColor(): bool
    {
        return $this->_color;
    }

    /**
     * @param bool $color
     */
    public function setColor(bool $color): void
    {
        $this->_color = $color;
    }

    /**
     * @return bool
     */
    public function isDuplex(): bool
    {
        return $this->_duplex;
    }

    /**
     * @param bool $duplex
     */
    public function setDuplex(bool $duplex): void
    {
        $this->_duplex = $duplex;
    }

    /**
     * @return ContentInterface|string|null
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param ContentInterface|string $content
     */
    public function setContent($content): void
    {
        $this->_content = $content;
    }


}
