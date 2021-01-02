<?php

namespace Continuity\PrintManager\Printers;

use Continuity\PrintManager\ContentInterface;
use Continuity\PrintManager\PrinterInterface;
use Continuity\PrintManager\PrintJobInterface;
use Generator;

class PJLPrinter
    implements PrinterInterface
{
    /**
     * @inheritDoc
     */
    public function data(PrintJobInterface $printJob): Generator
    {
        yield $this->escapeSequence("%-12345X@PJL\n");
        yield sprintf("@PJL SET DUPLEX=%s\n", $printJob->isDuplex() ? 'ON' : 'OFF');
        yield sprintf("@PJL SET QTY=%d\n", $printJob->getQuantity());
        yield sprintf("@PJL SET RENDERMODE=%s\n", $printJob->isColor() ? 'GRAYSCALE' : 'COLOR');

        if ($printJob->getContent() instanceof ContentInterface)
        {
            yield sprintf("@PJL ENTER LANGUAGE=%s\n", $printJob->getContent()->getType());
            yield $printJob->getContent()->getData();
        }
        else
        {
            yield $printJob->getContent();
        }

        yield $this->escapeSequence('%-12345X');
    }

    /**
     * @inheritDoc
     */
    public function getCapabilities(): array
    {
        // TODO: Implement getCapabilities() method.
    }

    //region Private Members
    /**
     * @param string $sequence
     *
     * @return string
     */
    private function escapeSequence(string $sequence): string
    {
        return chr(27) . $sequence;
    }

    //endregion
}
