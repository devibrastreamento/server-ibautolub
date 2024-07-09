<?php 
namespace app\model;
use mf\model\Model;

class Adm extends Model{
    private $id_adm;
    private $nome;
    private $status_ativo;
    private $permissao_cadastro;
    private $data_ativo;
    private $update_user;
    private $login;
    private $senha;
    private $email;
    private $token;

    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvar(){
        try {
            $sql = "INSERT INTO adm(nome,permissao_cadastro,data_ativo,login,senha,email,token) 
        VALUE(:nome,:permissao_cadastro,:data_ativo,:login,:senha,:email,:token)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome',$this->__get('nome'));
        $stmt->bindValue(':permissao_cadastro',$this->__get('permissao_cadastro'));
        $stmt->bindValue(':data_ativo',$this->__get('data_ativo'));
        $stmt->bindValue(':login',$this->__get('login'));
        $stmt->bindValue(':senha',$this->__get('senha'));
        $stmt->bindValue(':email',$this->__get('email'));
        $stmt->bindValue(':token',$this->__get('token'));
        $stmt->execute();
        header('location:/app/adm/sucesso?tipo=cadastro_adm');
        } catch (\Exception $e) {
            $autor = "adm";
            $tipo = "erro";
            $msg = "Cadastro ADM :".$e->getMessage();
            $data = date('Y-m-d h:i:s');
            $this->salvarDadosErro($autor,$this->__get('nome'),$tipo,$msg,$data);
            header('location:/app/adm/erro?tipo=cadastro_adm&msg='.$e->getMessage());
           echo $e->getMessage();
        }
    }
    public function verificarUsuario($login){
        $sql =  "SELECT id_adm,nome,login,senha,token,status_ativo,permissao_cadastro FROM adm WHERE login = '$login'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);       
        return $dados;
    }
    public function listarAdm(){
        $sql =  "SELECT a.id_adm,a.nome 'adm',a.permissao_cadastro,t.nome,a.status_ativo FROM adm a
        INNER JOIN  tb_status t ON t.id_status = a.status_ativo ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);       
        return $dados;
    }
    public function getQtdTotal(){
        $sql = "SELECT distinct
        (SELECT COUNT(nome) FROM adm WHERE status_ativo = 1 ) 'qtd_ativo',
        (SELECT COUNT(nome) FROM adm WHERE status_ativo = 2 ) 'qtd_inativo',
        (SELECT COUNT(nome) FROM adm) 'total'
        FROM adm";
         $stmt = $this->conexao->prepare($sql);
         $stmt->execute();
         $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);       
         return $dados;
    }
    public function getAdm($id){
        $sql =  "SELECT id_adm,permissao_cadastro,email,nome,login from adm where id_adm = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);       
        return $dados;
        
    }
    public function atualizarDadosAdm(){
       try {
        $sql = "UPDATE adm 
        SET nome=:nome,email=:email,update_user=:update_data,permissao_cadastro=:permissao_cadastro 
        WHERE id_adm = :id";
        $stmt= $this->conexao->prepare($sql);
        $stmt->bindValue(':id',$this->__get('id_adm'));
        $stmt->bindValue(':nome',$this->__get('nome'));
        $stmt->bindValue(':email',$this->__get('email'));
        $stmt->bindValue(':update_data',$this->__get('update_user'));
        $stmt->bindValue(':permissao_cadastro',$this->__get('permissao_cadastro'));
        $stmt->execute();
        header('location:/app/adm/sucesso?tipo=atualizar_adm');
       } catch (\PDOException $e) {
        $autor = "adm";
        $tipo = "erro";
        $msg = "Atualização ADM :".$e->getMessage();
        $data = date('Y-m-d h:i:s');
        $this->salvarDadosErro($autor,$this->__get('nome'),$tipo,$msg,$data);
        header('location:/app/adm/erro?tipo=atualizar_adm&msg='.$e->getMessage());
       }
        
    }
    public function ativarAdm($id){
        $sql = "UPDATE adm SET status_ativo = 1 WHERE id_adm = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function inativarAdm($id){
        $sql = "UPDATE adm SET status_ativo = 2 WHERE id_adm = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function recuperarLoginAdm($login){
        $sql = "SELECT login,id_adm FROM adm WHERE login = '$login'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function atualizarSenhaAdm(){
       try {
        $sql = "UPDATE adm SET
        login=:login,senha=:senha,token=:token WHERE id_adm = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id',$this->__get('id_adm'));
        $stmt->bindValue(':login',$this->__get('login'));
        $stmt->bindValue(':senha',$this->__get('senha'));
        $stmt->bindValue(':token',$this->__get('token'));
        $stmt->execute();
        header('location:/app/adm/sucesso?tipo=atualizar_adm_senha');
       } catch (\PDOException $e) {
        $autor = "adm";
        $tipo = "erro";
        $msg = "Atualização Senha ADM :".$e->getMessage();
        $data = date('Y-m-d h:i:s');
        $this->salvarDadosErro($autor,$this->__get('nome'),$tipo,$msg,$data);
        header('location:/app/adm/erro?tipo=atualizar_adm_senha&msg='.$e->getMessage());
       }
    }
    

}


?>