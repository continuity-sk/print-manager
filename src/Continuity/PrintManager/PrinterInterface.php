<?php


namespace Continuity\PrintManager
{
    use Generator;

    interface PrinterInterface
    {
        /**
         * @param PrintJobInterface $printJob
         *
         * @return Generator
         */
        public function data(PrintJobInterface $printJob): Generator;

        /**
         * @return array
         */
        public function getCapabilities(): array;
    }
}


