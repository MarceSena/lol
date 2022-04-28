<?php

namespace Repository;

use DB\MySQL;

class DDDRepository
{
    private object $MySQL;
    const TABELA = 'ddd';

    /**
     * UsuariosRepository constructor.
     */
    public function __construct()
    {
        $this->MySQL = new MySQL();
    }

    /**
     * @param $origem
     * @return int
     */
    public function getRegistroByOrigin($origem)
    {
        $consulta = 'SELECT * FROM ' . self::TABELA . ' WHERE origem = :origem';
        $stmt = $this->MySQL->getDb()->prepare($consulta);
        $stmt->bindParam(':origem', $origem);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    /**
     * @return MySQL|object
     */
    public function getMySQL()
    {
        return $this->MySQL;
    }
}