<?php

namespace Controller\DataEspaña;

use Mpwarfw\Component\Controller;
use Mpwarfw\Component\Container;
use Mpwarfw\Utils\Request;
use Templates\ShowHome;

class ControllerHome extends Controller
{
    public function index(Request $request)
    {
        $provinciasService = Container::getService("provinciasService");
        $result['provincias'] = $provinciasService->listAll();
        $topService = Container::getService("topService");
        $result['top10CP'] = $topService->getTop10MunicipiosUltimaSemana();
        $result['top6Provincias'] = $topService->getTop6Provincias();
        foreach($result['provincias'] as $provincia){
            if(array_key_exists($provincia['provincia_normalizada'], $result['top6Provincias'])){
                $result['top6Provincias'][$provincia['provincia_normalizada']] = array('visitas' => $result['top6Provincias'][$provincia['provincia_normalizada']], 'nombre' => $provincia['provincia']);
            }
        }
        return $result;
    }

    public function getView()
    {
        return new ShowHome();
    }

}