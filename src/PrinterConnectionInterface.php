<?php


namespace Continuity\PrintManager
{
    use Continuity\PrintManager\Exceptions\PrintManagerConnectException;
    use Continuity\PrintManager\Exceptions\PrintManagerDisconnectException;
    use Continuity\PrintManager\Exceptions\PrintManagerException;

    interface PrinterConnectionInterface
    {
        /**
         * Connect to printer
         *
         * @throws PrintManagerConnectException
         * @throws PrintManagerDisconnectException
         */
        public function connect(): void;

        /**
         * Disconnect from printer
         *
         * @throws PrintManagerConnectException
         * @throws PrintManagerDisconnectException
         */
        public function disconnect(): void;

        /**
         * Send data to printer
         *
         * @param string $data
         *
         * @throws PrintManagerConnectException
         * @throws PrintManagerException
         */
        public function send(string $data): void;

        /**
         * Check if printer is connected
         *
         * @return bool
         */
        public function isConnected(): bool;
    }
}

