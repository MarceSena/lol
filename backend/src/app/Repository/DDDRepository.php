<?php

namespace App\Repository;

use App\DB\MySQL;

class DDDRepository
{
    private object $MySQL;

    /**
     * DDDRepository constructor.
     */
    public function __construct()
    {
        $this->MySQL = new MySQL();
    }

    /**
     * @return MySQL|object
     */
    public function getMySQL()
    {
        return $this->MySQL;
    }
}
