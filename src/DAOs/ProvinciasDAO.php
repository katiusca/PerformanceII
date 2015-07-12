<?php

namespace DAOs;

use Mpwarfw\DBConnections\GenericDAO;

class ProvinciasDAO extends GenericDAO
{
    public function  getTable()
    {
        return "provincias";
    }

    public function getIdColumn()
    {
        return "id_provincia";
    }

}