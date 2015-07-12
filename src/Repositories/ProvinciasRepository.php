<?php

namespace Repositories;

use DAOs\ProvinciasDAO;
use Mpwarfw\Cache\MemoryCache;
use Mpwarfw\DBConnections\RedisDAO;
use Mpwarfw\Repository\BasicRepository;

class ProvinciasRepository extends BasicRepository
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
            $cache->set($cacheParams, $result,60);
        }
        return $result;
    }

    public function listarTodasLasProvincias()
    {
        $cache = new MemoryCache();
        $cacheParams = parent::getCacheDefinition(func_get_args(), __METHOD__);
        $result = $cache->get($cacheParams);
        if(!$result)
        {
            $result = self::getDao()->getAll();
            $cache->set($cacheParams, $result,30);
        }
        return $result;
    }

    public function incrementarBusquedasAProvincia($provincia)
    {
        return self::getRedisDao()->incrementBy1("visitasProvincia", $provincia);
    }

    public function getTop6Provincia()
    {
        return self::getRedisDao()->topN("visitasProvincia",6);
    }

    public function createDao()
    {
        return new ProvinciasDAO();
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