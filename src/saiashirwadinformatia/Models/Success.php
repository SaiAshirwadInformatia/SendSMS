<?php

namespace SaiAshirwadInformatia\Models;

class Success
{
    /**
     * @var mixed
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $message;

    /**
     * @param $type
     * @param $message
     */
    public function __construct($type, $message)
    {
        $this->type    = $type;
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->getMessage();
    }
}
