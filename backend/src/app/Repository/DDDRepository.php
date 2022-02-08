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
     * @param $login
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
     * @param $origem
     * @param $destino
     * @param $valor
     * @return int
     */
    public function insertDDD($origem, $destino, $valor)
    {
        $consultaInsert = 'INSERT INTO ' . self::TABELA . ' (origem, destino, valor) VALUES (:origin, :destino , :valor)';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($consultaInsert);
        $stmt->bindParam(':login', $origem);
        $stmt->bindParam(':senha', $destino);
        $stmt->bindParam(':login', $valor);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // /**
    //  * @param $id
    //  * @param $login
    //  * @param $senha
    //  * @return int
    //  */
    // public function updateUser($id, $dados)
    // {
    //     $consultaUpdate = 'UPDATE ' . self::TABELA . ' SET login = :login, senha = :senha WHERE id = :id';
    //     $this->MySQL->getDb()->beginTransaction();
    //     $stmt = $this->MySQL->getDb()->prepare($consultaUpdate);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->bindValue(':login', $dados['login']);
    //     $stmt->bindValue(':senha', $dados['senha']);
    //     $stmt->execute();
    //     return $stmt->rowCount();
    // }

    /**
     * @return MySQL|object
     */
    public function getMySQL()
    {
        return $this->MySQL;
    }
}