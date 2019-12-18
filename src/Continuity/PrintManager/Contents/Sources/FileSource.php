<?php


namespace Continuity\PrintManager\Contents\Sources;


use Continuity\PrintManager\SourceInterface;

class FileSource
    implements SourceInterface
{
    /** @var string */
    private $_filename;

    public function __construct(string $filename)
    {
        $this->_filename = $filename;
    }

    public function getData(): string
    {
        if (!file_exists($this->_filename))
        {
            // TODO: Throw something!
            return null;
        }

        return file_get_contents($this->_filename);
    }
}
