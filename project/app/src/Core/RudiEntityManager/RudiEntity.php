<?php
namespace RudiMVC\Core\RudiEntityManager;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;

class RudiEntity {

    private $isDevmode;
    private $paths;
    private $dbParams;
    private $ormConfig;

    public function __construct() {
        $this->dbCon = Yaml::parse(file_get_contents(DB_CONFIG_PATH));
        $this->paths = [ENTITIES_LOCATION];
        $this->isDevmode = false;
        $this->initDbParams();
        $this->initOrmConfig();
    }

    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager():EntityManagerInterface {
        $entityManager = EntityManager::create($this->dbParams, $this->ormConfig);
        return $entityManager;
    }

    /**
     * @return array
     */
    public function getDbParams():array {
        return $this->dbParams;
    }

    /**
     * @return Configuration
     */
    public function getOrmConfig():Configuration {
        return $this->ormConfig;
    }

    /**
     * @return array
     */
    public function getPaths():array {
        return $this->paths;
    }

    /**
     * @return bool
     */
    public function getDevMode():bool {
        return $this->isDevmode;
    }

    /**
     *
     */
    private function initDbParams():void {
        $this->dbParams = [
            'driver'   => 'pdo_mysql',
            'user'     =>  $this->dbCon['db_connection']['user'],
            'password' =>  $this->dbCon['db_connection']['password'],
            'dbname'   =>  $this->dbCon['db_connection']['database'],
            'host'   =>  $this->dbCon['db_connection']['host'],
        ];
    }

    /**
     *
     */
    private function initOrmConfig(): void {
        $this->ormConfig = Setup::createAnnotationMetadataConfiguration($this->paths, $this->isDevmode, null, null, false);
    }

}