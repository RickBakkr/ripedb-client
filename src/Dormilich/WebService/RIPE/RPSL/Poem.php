<?php
// Poem.php

namespace Dormilich\WebService\RIPE\RPSL;

use Dormilich\WebService\RIPE\Object;
use Dormilich\WebService\RIPE\AttributeInterface as Attr;

class Poem extends Object
{
    /**
     * Create a POEM RIPE object.
     * 
     * @param string $title Title of the poem that is represented by this object.
     * @return self
     */
    public function __construct($title)
    {
        $this->setType('poem');
        $this->setKey('poem');
        $this->init();
        $this->setAttribute('poem', $value);
    }

    /**
     * Defines attributes for the POEM RIPE object. 
     * 
     * @return void
     */
    protected function init()
    {
        $this->create('poem',    Attr::REQUIRED, Attr::SINGLE);
        $this->create('descr',   Attr::OPTIONAL, Attr::MULTIPLE);
        // FORM-HAIKU, FORM-LIMERICK, FORM-SONNET-ENGLISH, FORM-PROSE
        $this->matched('form',   Attr::REQUIRED, '/^FORM-/')
        $this->create('text',    Attr::REQUIRED, Attr::MULTIPLE);
        $this->create('author',  Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('remarks', Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('notify',  Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('mnt-by',  Attr::REQUIRED, Attr::SINGLE);
        $this->create('changed', Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('source',  Attr::REQUIRED, Attr::SINGLE);

        $this->generated('created');
        $this->generated('last-modified');
    }
}
