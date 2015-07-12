<?php

namespace Controller\DataEspaña;

use Mpwarfw\Component\Container;
use Mpwarfw\Component\Controller;
use Mpwarfw\Utils\Request;
use Templates\ShowMunicipios;

class ControllerMunicipios extends Controller
{
    const PAGINATION = 10;

    public function listMunicipiosPorProvincia(Request $request)
    {
        $municipiosService =  Container::getService("municipiosService");
        $result['provincia']  = $request->getParametersGet()[0];
        if(!isset($request->getParametersGet()[1]))
        {
            $page['begin'] = 1;
            $request->getSession()->setValue('page', $page['begin']);
            $result['page']= $request->getSession()->getValue('page');
        }else
        {
            $param = substr($request->getParametersGet()[1],4);
            $page = self::getBeginAndPage($param,$request);
            $result['page']= $page['page'];
        }
        $municipios = $municipiosService->listByProvincia($request->getParametersGet()[0],$page['begin']);
        $result['existe']= array_pop($municipios);
        $result['municipios']= $municipios;
        return $result;
    }

    public function getView()
    {
        return new ShowMunicipios();
    }

    private function getBeginAndPage($paramRequest, $session)
    {
        if($paramRequest < $session->getSession()->getValue('page'))
        {
            $result['page'] = $paramRequest;
            $session->getSession()->setValue('page',$paramRequest);
            $result['begin'] = $session->getSession()->getValue('page') * self::PAGINATION;
        }else
        {
            $session->getSession()->setValue('page',$paramRequest + 1);
            $result['page']= $session->getSession()->getValue('page');
            $result['begin'] = $session->getSession()->getValue('page') * self::PAGINATION;
        }
        return $result;
    }
}