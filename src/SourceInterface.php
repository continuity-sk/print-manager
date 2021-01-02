<?php


namespace Continuity\PrintManager;


interface SourceInterface
{
    /**
     * @return string
     */
    public function getData(): string;
}
