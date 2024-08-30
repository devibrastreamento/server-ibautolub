<?php 
namespace app\model;
use mf\model\Model;
use PDOException;

class Veiculo extends Model{
    private $id_veiculo;
    private $id_cliente;
    private $tipo;
    private $placa;
    private $hodometro;
    private $marca;
    private $modelo;
    private $cor;
    private $data_troca_oleo;
    private $update_troca_oleo;

    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvarVeiculoDireto(){
        try {
            $sql = "INSERT INTO veiculo(id_cliente,tipo,placa,marca,modelo,cor)
            VALUE(:id_cliente,:tipo,:placa,:marca,:modelo,:cor)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id_cliente',$this->__get('id_cliente'));
            $stmt->bindValue(':tipo',$this->__get('tipo'));
            $stmt->bindValue(':placa',$this->__get('placa'));
            $stmt->bindValue(':marca',$this->__get('marca'));
            $stmt->bindValue(':modelo',$this->__get('modelo'));
            $stmt->bindValue(':cor',$this->__get('cor'));
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }
    public function salvarVeiculoDiretoPost(){
        try {
            $sql = "INSERT INTO veiculo(id_cliente,tipo,placa,marca,modelo,cor,hodometro)
            VALUE(:id_cliente,:tipo,:placa,:marca,:modelo,:cor,:hodometro)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id_cliente',$this->__get('id_cliente'));
            $stmt->bindValue(':tipo',$this->__get('tipo'));
            $stmt->bindValue(':placa',$this->__get('placa'));
            $stmt->bindValue(':marca',$this->__get('marca'));
            $stmt->bindValue(':modelo',$this->__get('modelo'));
            $stmt->bindValue(':cor',$this->__get('cor'));
            $stmt->bindValue(':hodometro',$this->__get('hodometro'));
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }
    public function getVeiculo($id){
        $sql = "SELECT id_veiculo,id_cliente,tipo,placa,marca,modelo,cor,hodometro,data_troca_oleo,update_troca_oleo
        FROM veiculo WHERE id_cliente = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getVeiculoPreview($id){
        $sql = "SELECT id_veiculo,tipo,placa,modelo
        FROM veiculo WHERE id_cliente = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getVeiculoDetalhe($id){
        $sql = "SELECT id_veiculo,id_cliente,tipo,placa,marca,modelo,cor,hodometro,data_troca_oleo,update_troca_oleo
        FROM veiculo WHERE id_veiculo = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function removerVeiculo($id){
        $sql = "DELETE FROM veiculo WHERE id_veiculo = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados =  $stmt;
        return $dados;
    }
}

?>