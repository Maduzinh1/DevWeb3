<?php
require_once ("Login.class.php");
require_once ("Database.class.php");

class Usuario {
    private $id;
    private $nome;
    private $email; // login
    private $senha;
    private $matricula;
    private $contato;
    private $login; // objeto login

    // construtor da classe
    public function __construct($id, $nome, $email, $senha, $matricula, $contato) {
        $this->setId($id);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setMatricula($matricula);
        $this->setContato($contato);
      //  $this->login->setIdSession(1);
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        if ($id < 0) {
            throw new Exception('Erro. O ID deve ser maior ou igual a 0');
        } else {
            $this->id = $id;
        }
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        if ($nome == "") {
            throw new Exception('Erro. Informe um nome.');
        } else {
            $this->nome = $nome;
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $padrao = "/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        if (($email == "") && !preg_match($padrao,strtolower($email))) {
            throw new Exception('Erro. Informe um email.');
        } else {
            $this->email = $email;
        }
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        if ($senha == "") { // regras para senha
            throw new Exception('Erro. Informe uma senha válida.');
        } else {
            $this->senha = $senha;
        }
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function setMatricula($matricula) {
        if ($matricula == "") { // regras para matricula
            throw new Exception('Erro. Informe uma matricula válida.');
        } else {
            $this->matricula = $matricula;
        }
    }

    public function getContato() {
        return $this->contato;
    }

    public function setContato($contato) {
        if ($contato == "") { // regras para contato
            throw new Exception('Erro. Informe um contato válida.');
        } else {
            $this->contato = $contato;
        }
    }

    public function __toString():String {  
        $str = "Usuário: ".$this->getId()." - ".$this->getNome()." - ".$this->getEmail();        
        return $str;
    }

    public function inserir():Bool {
        $sql = "INSERT INTO Usuario (nome, email, senha, matricula, contato)
                VALUES (:nome, :email, :senha, :matricula, :contato);";
        $parametros = array(':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato());
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array {
        $sql = "SELECT * FROM usuario";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id;"; break; // filtro por ID
            case 2: $sql .= " WHERE nome like :info ORDER BY nome;"; $info = '%'.$info.'%'; break; // filtro por nome
            case 3: $sql .= " WHERE matricula = :info ORDER BY id;"; break; // filtro por matricula
        }
        $parametros = array();
        if ($tipo > 0) {
            $parametros = [':info'=>$info];
        }
        $comando = Database::executar($sql, $parametros);
        $usuarios = [];
        while ($registro = $comando->fetch()) {
            $usuario = new Usuario($registro['id'], $registro['nome'], $registro['email'], $registro['senha'], $registro['matricula'], $registro['contato']);
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    public function alterar():Bool {       
        $sql = "UPDATE usuario
                SET nome = :nome, 
                    email = :email,
                    senha = :senha,
                    matricula = :matricula,
                    contato = :contato
                WHERE id = :id;";
        $parametros = array(':id'=>$this->getId(),
                            ':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool {
        $sql = "DELETE FROM usuario
                WHERE id = :id;";
        $parametros = array(':id'=>$this->getId());
        return Database::executar($sql, $parametros) == true;
    }
}
?>