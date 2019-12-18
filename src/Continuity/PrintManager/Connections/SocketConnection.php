<?php


namespace Continuity\PrintManager\Connections
{
    use Continuity\PrintManager\Exceptions\PrintManagerConnectException;
    use Continuity\PrintManager\Exceptions\PrintManagerDisconnectException;
    use Continuity\PrintManager\Exceptions\PrintManagerException;
    use Continuity\PrintManager\PrinterConnectionInterface;

    /**
     * Class SocketConnection
     *
     * @package Continuity\PrintManager\Connections
     */
    class SocketConnection
        implements PrinterConnectionInterface
    {
        /** @var string */
        private $_host;

        /** @var int */
        private $_port;

        /** @var int */
        private $_errorNo;

        /** @var string */
        private $_errorStr;

        /** @var int */
        private $_timeout;

        /** @var Resource|null */
        private $_socket;

        /**
         * Printer constructor.
         *
         * @param string $host
         * @param int    $port
         * @param int    $timeout
         */
        public function __construct(string $host, int $port = 9100, int $timeout = 30)
        {
            $this->_host = $host;
            $this->_port = $port;
            $this->_timeout = $timeout;
        }

        /**
         * @inheritDoc
         */
        public function connect(): void
        {
            if ($this->isConnected())
            {
                $this->disconnect();
            }

            $socket = fsockopen($this->_host, $this->_port,
                $this->_errorNo, $this->_errorStr, $this->_timeout);

            if ($socket === false)
            {
                throw new PrintManagerConnectException($this->_errorStr, $this->_errorNo);
            }

            $this->_socket = $socket;
        }

        /**
         * @inheritDoc
         */
        public function disconnect(): void
        {
            $this->ensureConnected();

            if (fclose($this->_socket) === false)
            {
                throw new PrintManagerDisconnectException('Unable to close Printer connection.');
            }

            $this->_socket = null;
        }

        /**
         * @inheritDoc
         */
        public function send(string $data): void
        {
            $this->ensureConnected();
            $size = strlen($data);

            if (($written = fwrite($this->_socket, $data, $size)) !== $size)
            {
                throw new PrintManagerException("Error writing data to socket (expected: {$size}, written: {$written}).");
            }
        }

        /**
         * @inheritDoc
         */
        public function isConnected(): bool
        {
            return $this->_socket !== null;
        }

        // region Private Members

        /**
         * Ensure socket connection is open.
         *
         * @throws PrintManagerConnectException
         */
        private function ensureConnected(): void
        {
            if (!$this->isConnected())
            {
                throw new PrintManagerConnectException('Not connected.');
            }
        }
        // endregion
    }
}


