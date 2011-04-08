<?php


class Firegento_SqlProfiler_Model_Resource_Type_Db_Pdo_Mysql extends Mage_Core_Model_Resource_Type_Db_Pdo_Mysql
{

    /**
     * Enter description here...
     *
     * @param array $config Connection config
     * @return Varien_Db_Adapter_Pdo_Mysql
     */
    public function getConnection($config)
    {
        $configArr = (array)$config;
        $configArr['profiler'] = !empty($configArr['profiler']) && $configArr['profiler']!=='false' ? $configArr['profiler']->asArray() : false;
        $conn = $this->_getDbAdapterInstance($configArr);

        if (!empty($configArr['initStatements']) && $conn) {
            $conn->query($configArr['initStatements']);
        }

        return $conn;
    }
}
