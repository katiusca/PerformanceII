<?php

namespace Repositories;

use DAOs\MunicipiosDAO;
use Mpwarfw\Cache\MemoryCache;
use Mpwarfw\DBConnections\RedisDAO;
use Mpwarfw\Repository\BasicRepository;

class MunicipiosRepository extends BasicRepository
{
    private $redisDao;

    public function getById($id)
    {
        $cache = new MemoryCache();
        $cacheParams = parent::getCacheDefinition(func_get_args(), __METHOD__);
        $result = $cache->get($cacheParams);
        if(!$result)
        {
            $result = self::getDao()->get($id);
            $cache->set($cacheParams, $result, 1);
        }
        return $result;
    }

    public function getAllMunicipios($option)
    {
        $sql = "select concat(LPAD(id_provincia, 2, '0'),LPAD(cod_municipio,3,'0')) cp, nombre from ".self::getDao()->getTable()." where ".self::getDao()->getNameColumn() ." like '".$option."%'";
        $result = self::getDao()->executeQuery($sql);
        return $result;
    }

    public function incrementarBusquedasACodigoPostal($cp)
    {
        $semanaActual = self::getCurrentWeek();
        self::getRedisDao()->incrementBy1("visitasCP".$semanaActual->format("Ymd"), $cp);
    }

    public function getTop10CodigosPostalesSemanaPasada()
    {
        $semanaPasada = self::getPreviousWeek();
        $top10 = self::getRedisDao()->topN("visitasCP".$semanaPasada->format("Ymd"), 10);
        return $top10;
    }

    private function getCurrentWeek()
    {
        $diff1Day = new \DateInterval('P1D');
        $diff1Day->invert = 1;
        $monday = new \DateTime();
        while($monday->format('N')>1){
            $monday->add($diff1Day);
        }
        return $monday;
    }

    private function getPreviousWeek()
    {
        $diff7Days = new \DateInterval('P7D');
        $diff7Days->invert = 1;
        $lastWeekMonday = self::getCurrentWeek();
        $lastWeekMonday->add($diff7Days);
        return $lastWeekMonday;
    }

    public function createDao()
    {
        return new MunicipiosDAO();
    }

    public function getRedisDao()
    {
        if($this->redisDao==null)
        {
            $this->redisDao = new RedisDAO();
        }
        return $this->redisDao;
    }

}