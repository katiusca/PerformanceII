<?php

namespace Repositories;

use Mpwarfw\DBConnections\Sphinx;
use Foolz\SphinxQL\SphinxQL;

class MunicipiosSphinx extends Sphinx
{

    public function getMunicipiosByProvincias($provincia,$begin = 1,$end = 11)
    {
        $query = SphinxQL::create($this->getConnection())->select('municipio')
                            ->from('municipios')
                            ->match('provincia_normalizada',$provincia)
                            ->limit($begin,$end);
        $results = $query->execute();
        $results = self::check($results);
        if(!empty($results))
        {
            return $results;
        }else
        {
            throw new \Exception("No hay municipios");
        }
    }

    private function check($results)
    {
        $exist = count($results);
        if ($exist > 10)
        {
            $results[$exist] = ['exist' => 1];
            return $results;
        }else
        {
            $results[$exist] = ['exist' => 0];
            return $results;
        }
    }
}
