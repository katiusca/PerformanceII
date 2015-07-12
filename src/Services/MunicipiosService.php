<?php

namespace Services;

use Repositories\MunicipiosRepository;
use Repositories\MunicipiosSphinx;
use Repositories\ProvinciasRepository;

class MunicipiosService
{

    private $repository;
    private $municipiosRepository;
    private $provinciasRepository;

    public function listByProvincia($provincia,$begin)
    {
        $result = self::getRepositorySphinx()->getMunicipiosByProvincias($provincia ,$begin);
        if($result)
        {
            self::getProvinciasRepository()->incrementarBusquedasAProvincia($provincia);
        }
        return $result;
    }

    public function searchMunicipios($option)
    {
        $matchingMunicipios = self::getMunicipiosRepository()->getAllMunicipios($option);
        //$returnValue = array();
        //foreach($matchingMunicipios as $key=>$value){
        //    array_push($returnValue, array($value['id_municipio']=>$value['nombre']));
        //}
        //$returnValue = array("municipios" => $returnValue);
        //return $returnValue;
        return $matchingMunicipios;
    }

    public function getRepositorySphinx()
    {
        if($this->repository==null)
        {
            $this->repository = new MunicipiosSphinx();
        }
        return $this->repository;
    }

    public function getMunicipiosRepository()
    {
        if($this->municipiosRepository==null)
        {
            $this->municipiosRepository = new MunicipiosRepository();
        }
        return $this->municipiosRepository;
    }

    public function getProvinciasRepository()
    {
        if($this->provinciasRepository==null)
        {
            $this->provinciasRepository = new ProvinciasRepository();
        }
        return $this->provinciasRepository;
    }

}