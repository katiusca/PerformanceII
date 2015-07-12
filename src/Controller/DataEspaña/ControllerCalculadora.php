<?php

namespace Controller\DataEspaña;

use Mpwarfw\Component\Controller;
use Mpwarfw\Component\Container;
use Mpwarfw\Component\Validate;
use Mpwarfw\Utils\Request;
use Templates\ShowCalculadora;

class ControllerCalculadora extends Controller
{
    public function buscar(Request $request)
    {
        if(isset($request->getParametersGet()[0]))
        {
            $validate = new Validate($request->getParametersGet());
            $code = $validate->checkInt(0);
            if($code != NULL)
            {
                $provinciasService =  Container::getService("provinciasService");
                $result = $provinciasService->getProvinciaPorCodigoPostal($code);
                return $result;
            }
        }
    }

    public function getView()
    {
        return new ShowCalculadora();
    }

}