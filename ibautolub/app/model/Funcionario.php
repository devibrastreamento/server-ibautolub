<?php 
namespace app\model;
use mf\model\Model;

class Funcionario extends Model{
    private $id_funcionario;
    private $id_adm;
    private $nome;
    private $id_profissao;
    private $data_cadastro;
    private $email;
    private $descricao_atividade;
    private $login;
    private $senha;
    private $token;
    private $status_ativo;

    public function __set($atr,$value){
        $this->$atr =$value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvar(){
        try {
            $sql = "INSERT INTO funcionario(id_adm,nome,id_profissao,data_cadastro,descricao_atividade,login,senha,token,email)
            VALUE(:id_adm,:nome,:id_profissao,:data_cadastro,:descricao_atividade,:login,:senha,:token,:email)
            ";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id_adm',$this->__get('id_adm'));
            $stmt->bindValue(':nome',$this->__get('nome'));
            $stmt->bindValue(':id_profissao',$this->__get('id_profissao'));
            $stmt->bindValue(':data_cadastro',$this->__get('data_cadastro'));
            $stmt->bindValue(':descricao_atividade',$this->__get('descricao_atividade'));
            $stmt->bindValue(':login',$this->__get('login'));
            $stmt->bindValue(':senha',$this->__get('senha'));
            $stmt->bindValue(':token',$this->__get('token'));
            $stmt->bindValue(':email',$this->__get('email'));
            $stmt->execute();
            header('location:/app/adm/sucesso?tipo=cadastro_funcionario');
        } catch (\Exception $e) {
            header('location:/app/adm/erro?tipo=cadastro_funcionario&msg='.$e->getMessage());
           echo $e->getMessage();
        }
    }
    public function getAllFuncionario(){
        $sql = "SELECT f.status_ativo,f.id_funcionario,f.id_adm,f.nome 'funcionario',p.nome_profissao ,tb.nome'status' 
        FROM funcionario f
        INNER JOIN tb_status tb ON f.status_ativo = tb.id_status
        INNER JOIN profissao p ON f.id_profissao = p.id_profissao";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getFuncionario($id){
        $sql = "SELECT f.nome,f.login,p.nome_profissao,f.id_profissao,f.email,f.descricao_atividade
        FROM funcionario f
        INNER JOIN profissao p ON f.id_profissao = p.id_profissao 
        WHERE id_funcionario = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;

    }
    public function atualizarDados(){
        try {
            $sql = "UPDATE funcionario SET nome=:nome,email=:email,id_profissao=:id_profissao,
        descricao_atividade=:descricao_atividade WHERE id_funcionario = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id',$this->__get('id_funcionario'));
        $stmt->bindValue(':nome',$this->__get('nome'));
        $stmt->bindValue(':id_profissao',$this->__get('id_profissao'));
        $stmt->bindValue(':descricao_atividade',$this->__get('descricao_atividade'));
        $stmt->bindValue(':email',$this->__get('email'));
        $stmt->execute();
        header('location:/app/adm/sucesso?tipo=atualizacao_funcionario');
        } catch (\PDOException $e) {
            header('location:/app/adm/erro?tipo=atualizacao_funcionario&msg='.$e->getMessage());
          echo $e->getMessage();
        }
    }
    public function getNomeUser($id){
        $sql = "SELECT nome,email,login,senha,token FROM funcionario WHERE id_funcionario = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;

    }
    public function atualizarSenha(){
        try {
            $sql = "UPDATE funcionario SET login=:login,senha=:senha,token=:token WHERE id_funcionario = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id',$this->__get('id_funcionario'));
        $stmt->bindValue(':login',$this->__get('login'));
        $stmt->bindValue(':senha',$this->__get('senha'));
        $stmt->bindValue(':token',$this->__get('token'));      
        $stmt->execute();
        header('location:/app/adm/sucesso?tipo=atualizar_senha');
        } catch (\PDOException $e) {
            header('location:/app/adm/erro?tipo=atualizar_senha&msg='.$e->getMessage());
          echo $e->getMessage();
        }
    }
    public function desativarFuncionario($id){
        $sql = "UPDATE funcionario SET status_ativo=2 WHERE id_funcionario = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;

    }
    public function ativarFuncionario($id){
        $sql = "UPDATE funcionario SET status_ativo=1 WHERE id_funcionario = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;

    }
    public function recuperarLoginFun($login){
        $sql = "SELECT token,login,id_funcionario,id_funcionario,nome,status_ativo FROM funcionario WHERE login = '$login'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getTotalFuncionario(){
        $sql = "SELECT distinct
        (SELECT COUNT(nome) FROM funcionario WHERE status_ativo = 1 ) 'qtd_ativo',
        (SELECT COUNT(nome) FROM funcionario WHERE status_ativo = 2 ) 'qtd_inativo',
        (SELECT COUNT(nome) FROM funcionario ) 'total'
        FROM funcionario";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;

    }
  
    
    
    
    
}


?>