<?php

namespace SaiAshirwadInformatia\Models;

class Balance
{

    /**
     * @var mixed
     */
    protected $count;

    /**
     * @param $count
     */
    public function __construct($count = 0)
    {
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

}
