<?php 
namespace mf\model;

class Model{
    protected $conexao;
    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }
    protected function salvarDadosErro($autor,$receptor,$tipo,$msg,$data_cadastro){
        
        $sql = "INSERT INTO tb_log(autor,receptor,tipo,msg,data_cadastro)VALUES(:autor,:receptor,:tipo,:msg,:data_cadastro)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':autor',$autor);
        $stmt->bindValue(':receptor',$receptor);
        $stmt->bindValue(':tipo',$tipo);
        $stmt->bindValue(':msg',$msg);
        $stmt->bindValue(':data_cadastro',$data_cadastro);
        $stmt->execute();
       
    }
}

?>