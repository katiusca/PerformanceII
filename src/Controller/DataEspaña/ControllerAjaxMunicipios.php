<?php

namespace Controller\DataEspaña;

use Mpwarfw\Component\Container;
use Mpwarfw\Component\ControllerJson;
use Mpwarfw\Utils\Request;

class ControllerAjaxMunicipios extends ControllerJson
{

    public function getMunicipiosByTruncatedName(Request $request)
    {
        if(isset($request->getParametersGet()[0]))
        {
            $municipiosService =  Container::getService("municipiosService");
            $result = $municipiosService->searchMunicipios($request->getParametersGet()[0]);
            return $result;
        }
    }

}