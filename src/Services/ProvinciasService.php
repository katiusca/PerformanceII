<?php

namespace Services;

use Repositories\MunicipiosRepository;
use Repositories\ProvinciasRepository;

class ProvinciasService
{

    private $repository;
    private $municipiosRepository;

    public function listAll()
    {
        return self::getRepository()->listarTodasLasProvincias();
    }

    public function getById($id)
    {
        return self::getRepository()->getById($id);
    }

    public function getProvinciaPorCodigoPostal($cp){
        $code = substr($cp,0,2);
        $result = $this->getById($code);
        if($result){
            self::getMunicipiosRepository()->incrementarBusquedasACodigoPostal($cp);
        }
        return $result;
    }

    public function getRepository()
    {
        if($this->repository==null)
        {
            $this->repository = new ProvinciasRepository();
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

}