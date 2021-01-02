<?php


namespace Continuity\PrintManager
{
    use Continuity\PrintManager\Exceptions\PrintManagerException;

    class PrinterManager
    {
        /** @var array */
        private $_printers = [];

        public function addPrinter(string $id, PrinterConnectionInterface $conn, PrinterInterface $printer): void
        {
            $this->_printers[$id] = [$conn, $printer];
        }

        /**
         * Handle print jobs
         *
         * @param string            $id
         * @param PrintJobInterface $printJob
         *
         * @throws PrintManagerException
         */
        public function print(string $id, PrintJobInterface $printJob): void
        {
            if (!array_key_exists($id, $this->_printers))
            {
                throw new PrintManagerException('Printer not listed.');
            }

            [$conn, $printer] = $this->_printers[$id];

            $conn->connect();
            foreach ($printer->data($printJob) as $data)
            {
                $conn->send($data);
            }
            $conn->disconnect();
        }

        /**
         * @return array
         */
        public function getPrinters(): array
        {
            return $this->_printers;
        }
    }
}


