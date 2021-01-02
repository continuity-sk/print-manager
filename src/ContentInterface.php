<?php


namespace Continuity\PrintManager;


interface ContentInterface
{
    public function getType(): string;

    public function getData(): string;
}
