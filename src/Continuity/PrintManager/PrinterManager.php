<?php


namespace Continuity\PrintManager
{
    class PrinterManager
    {
        /** @var array */
        private $_printers = [];

        public function addPrinter(string $id, PrinterConnectionInterface $conn, PrinterInterface $printer): void
        {
            $this->_printers[$id] = [$conn, $printer];
        }

        public function print(string $id, PrintJobInterface $printJob): void
        {
            if (!array_key_exists($id, $this->_printers))
            {
                // TODO: Throw
                return;
            }

            [$conn, $printer] = $this->_printers[$id];

            $conn->connect();
            foreach ($printer->data($printJob) as $data)
            {
                $conn->send($data);
            }
            $conn->disconnect();
        }
    }
}


