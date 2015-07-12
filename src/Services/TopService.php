<?php

namespace Services;

use Repositories\MunicipiosRepository;
use Repositories\ProvinciasRepository;

class TopService
{

    private $municipiosRepository;
    private $provinciasRepository;

    public function getTop10MunicipiosUltimaSemana()
    {
        return self::getMunicipiosRepository()->getTop10CodigosPostalesSemanaPasada();
    }

    public function getTop6Provincias()
    {return self::getProvinciasRepository()->getTop6Provincia();

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