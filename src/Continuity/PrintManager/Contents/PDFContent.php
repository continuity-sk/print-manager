<?php


namespace Continuity\PrintManager\Contents;

class PDFContent
    extends AbstractContent
{
    public const TYPE = 'PDF';

    /**
     * PDFContent constructor.
     *
     * @param string|FileSource $data
     */
    public function __construct($data)
    {
        parent::__construct(self::TYPE, $data);
    }
}
