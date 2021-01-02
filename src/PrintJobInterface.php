<?php


namespace Continuity\PrintManager
{
    interface PrintJobInterface
    {
        public function isDuplex(): bool;

        public function setDuplex(bool $value): void;

        public function getQuantity(): int;

        public function setQuantity(int $qty): void;

        public function isColor(): bool;

        public function setColor(bool $value): void;

        /**
         * @return string|ContentInterface|null
         */
        public function getContent();

        /**
         * @param string|ContentInterface $content
         *
         * @return mixed
         */
        public function setContent($content);

    }
}


