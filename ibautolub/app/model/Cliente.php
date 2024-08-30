<?php 
namespace app\model;
use mf\model\Model;

class Cliente extends Model{
    private $id_cliente;
    private $id_funcionario;
    private $nome;
    private $cpf_cnpj;
    private $telefone;
    private $email;
    private $data_cadastro;
    private $pontuacao;
    private $login;
    private $senha;
    private $token;


    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function loginCliente($login){
        $sql = "SELECT token,login,id_cliente,id_funcionario,nome,status_ativo FROM clientes WHERE login = '$login'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function salvarDadosBasico(){
        try{
            $sql = "INSERT INTO clientes(id_funcionario,nome,cpf_cnpj,telefone,email,data_cadastro,login,senha,token)
            VALUE(:id_funcionario,:nome,:cpf_cnpj,:telefone,:email,:data_cadastro,:login,:senha,:token)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id_funcionario',$this->__get('id_funcionario'));
            $stmt->bindValue(':nome',$this->__get('nome'));
            $stmt->bindValue(':cpf_cnpj',$this->__get('cpf_cnpj'));
            $stmt->bindValue(':telefone',$this->__get('telefone'));
            $stmt->bindValue(':email',$this->__get('email'));
            $stmt->bindValue(':data_cadastro',$this->__get('data_cadastro'));
            $stmt->bindValue(':login',$this->__get('login'));
            $stmt->bindValue(':senha',$this->__get('senha'));
            $stmt->bindValue(':token',$this->__get('token'));
            $stmt->execute();
            header('location:/app/fun/sucesso?tipo=cadastro_cliente');
        }catch(\PDOException $e){
            $autor = $this->__get('id_funcionario');
            $tipo = "erro";
            $msg = "Cadastro Cliente:".$e->getMessage();
            $data = date('Y-m-d h:i:s');
            $this->salvarDadosErro($autor,$this->__get('nome'),$tipo,$msg,$data);
            header('location:/app/fun/erro?tipo=cadastro_cliente&msg='.$e->getMessage());
        }
    }
    public function configCpfCnpj($cpf){
        $novoCpf = str_replace('-','',$cpf);
        $cpfNovo = str_replace('/','',$novoCpf);
        $newCpf = str_replace('.','',$cpfNovo);
        return trim($newCpf);
    }
    public function getCliente($id){
        $sql = "SELECT token,login,id_cliente,id_funcionario,nome,status_ativo,cpf_cnpj,email,telefone 
        FROM clientes WHERE id_cliente = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function recuperarLoginFun($login){
        $sql = "SELECT token,login,id_cliente,id_funcionario,nome,status_ativo FROM clientes WHERE login = '$login'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getAllClientes(){
        $sql = "SELECT nome,id_cliente,cpf_cnpj,telefone,email,data_cadastro,status_ativo FROM clientes";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getClienteNome($nome){
        $sql = "SELECT c.id_cliente,c.nome,c.status_ativo,c.pontuacao,v.modelo
        FROM clientes c
        LEFT JOIN veiculo v ON c.id_cliente = v.id_cliente 
        WHERE nome LIKE '%$nome%'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function editarCliente(){
        try {
            $sql = "UPDATE clientes SET nome=:nome,email=:email,telefone=:telefone,cpf_cnpj=:cpf_cnpj 
            WHERE id_cliente = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id',$this->__get('id_cliente'));
            $stmt->bindValue(':nome',$this->__get('nome'));
            $stmt->bindValue(':cpf_cnpj',$this->__get('cpf_cnpj'));
            $stmt->bindValue(':telefone',$this->__get('telefone'));
            $stmt->bindValue(':email',$this->__get('email'));
            $stmt->execute();
            header('location:/app/fun/sucesso?tipo=editar_cadastro_cliente');
        } catch (\PDOException $e) {
            $autor = "funcionario";
            $tipo = "erro";
            $msg = "Editar dados Cliente:".$e->getMessage();
            $data = date('Y-m-d h:i:s');
            $this->salvarDadosErro($autor,$this->__get('id_cliente'),$tipo,$msg,$data);
            echo $e->getMessage();
            header('location:/app/fun/erro?tipo=editar_cadastro_cliente&msg='.$e->getMessage());
        }
    }
    public function editarSenha(){
        try {
            $sql = "UPDATE clientes SET login=:login,senha=:senha,token=:token  
            WHERE id_cliente = :id";
             $stmt = $this->conexao->prepare($sql);
             $stmt->bindValue(':id',$this->__get('id_cliente'));
             $stmt->bindValue(':login',$this->__get('login'));
             $stmt->bindValue(':senha',$this->__get('senha'));
             $stmt->bindValue(':token',$this->__get('token'));
             $stmt->execute();
             header('location:/app/fun/sucesso?tipo=editar_senha_cliente');
        } catch (\PDOException $e) {
            $autor = "funcionario";
            $tipo = "erro";
            $msg = "Editar Senha Cliente:".$e->getMessage();
            $data = date('Y-m-d h:i:s');
            $this->salvarDadosErro($autor,$this->__get('login'),$tipo,$msg,$data);
            header('location:/app/fun/erro?tipo=editar_senha_cliente&msg='.$e->getMessage());
        }
    }
    public function editSideClientPassword(){
        try {
            $sql = "UPDATE clientes SET login=:login,senha=:senha,token=:token  
            WHERE id_cliente = :id";
             $stmt = $this->conexao->prepare($sql);
             $stmt->bindValue(':id',$this->__get('id_cliente'));
             $stmt->bindValue(':login',$this->__get('login'));
             $stmt->bindValue(':senha',$this->__get('senha'));
             $stmt->bindValue(':token',$this->__get('token'));
             $stmt->execute();
             header('location:/app/client/sucesso?tipo=editar_senha_cliente');
        } catch (\PDOException $e) {
            $autor = "funcionario";
            $tipo = "erro";
            $msg = "Editar Senha Cliente(lado Client):".$e->getMessage();
            $data = date('Y-m-d h:i:s');
            $this->salvarDadosErro($autor,$this->__get('login'),$tipo,$msg,$data);
            header('location:/app/client/erro?tipo=editar_senha_cliente&msg='.$e->getMessage());
        }
    }
    public function editSideClient(){
        try {
            $sql = "UPDATE clientes SET nome=:nome,email=:email,telefone=:telefone,cpf_cnpj=:cpf_cnpj 
            WHERE id_cliente = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id',$this->__get('id_cliente'));
            $stmt->bindValue(':nome',$this->__get('nome'));
            $stmt->bindValue(':cpf_cnpj',$this->__get('cpf_cnpj'));
            $stmt->bindValue(':telefone',$this->__get('telefone'));
            $stmt->bindValue(':email',$this->__get('email'));
            $stmt->execute();
            header('location:/app/client/sucesso?tipo=editar_cadastro_cliente');
        } catch (\PDOException $e) {
            $autor = "funcionario";
            $tipo = "erro";
            $msg = "Editar dados Cliente(lado Client):".$e->getMessage();
            $data = date('Y-m-d h:i:s');
            $this->salvarDadosErro($autor,$this->__get('nome'),$tipo,$msg,$data);
            echo $e->getMessage();
            header('location:/app/client/erro?tipo=editar_cadastro_cliente&msg='.$e->getMessage());
        }
    }
    
    public function ativarUsuario($id_cliente){
        $sql = "UPDATE clientes SET status_ativo = 1
        WHERE id_cliente = $id_cliente";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
        
    }
    public function desativarUsuario($id_cliente){
        $sql = "UPDATE clientes SET status_ativo = 2
        WHERE id_cliente = $id_cliente";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
        
    }
}
?>