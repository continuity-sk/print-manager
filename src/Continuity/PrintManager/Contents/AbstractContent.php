<?php


namespace Continuity\PrintManager\Contents
{
    use Continuity\PrintManager\ContentInterface;
    use Continuity\PrintManager\SourceInterface;

    abstract class AbstractContent
        implements ContentInterface
    {
        /** @var string */
        private $_type;
        /** @var SourceInterface|string */
        private $_data;

        /**
         * AbstractContent constructor.
         *
         * @param string                 $type
         * @param string|SourceInterface $data
         */
        protected function __construct(string $type, $data)
        {
            $this->_data = $data;
            $this->_type = $type;
        }

        /**
         * @return string
         */
        public function getType(): string
        {
            return $this->_type;
        }

        /**
         * @return string
         */
        public function getData(): string
        {
            if ($this->_data instanceof SourceInterface)
            {
                return $this->_data->getData();
            }

            return $this->_data;
        }
    }
}


