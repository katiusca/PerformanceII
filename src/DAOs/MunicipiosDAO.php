<?php
namespace DAOs;

use Mpwarfw\DBConnections\GenericDAO;

class MunicipiosDAO extends GenericDAO
{
    public function  getTable()
    {
        return "municipios";
    }

    public function getIdColumn()
    {
        return "id_municipios";
    }

    public function getNameColumn()
    {
        return "nombre";
    }
}