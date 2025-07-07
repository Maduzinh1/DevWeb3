<?php
require_once ("Database.class.php");
require_once ("Formulario.interface.php");

abstract class Usuario implements Formulario {
    private $id;
    private $nome;
    private $email; // login
    private $senha;
    private $matricula;
    private $contato;
    private $login; // objeto login
    private $tipo;

    // construtor da classe
    public function __construct($id, $nome, $email, $senha, $matricula, $contato) {
        $this->setId($id);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setMatricula($matricula);
        $this->setContato($contato);
      //  $this->login->setIdSession(1);
        $this->tipo = get_class($this); // pega de acordo com o tipo de objeto
    }

    public function getId():int {
        return $this->id;
    }
    
    public function setId($id) {
        if ($id < 0) {
            throw new Exception('Erro. O ID deve ser maior ou igual a 0');
        } else {
            $this->id = $id;
        }
    }

    public function getNome():String {
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

    public function getTipo():String {
        return isset($this->tipo)?$this->tipo:"";
    }

    public function setTipo($tipo) {
        if ($tipo < 0) {
            throw new Exception("Erro, o tipo deve ser maior que 0!");
        } else {
            $this->tipo = $tipo;
        }
    }

    public function __toString():String {  
        $str = "Usuário: ".$this->getId()." - ".$this->getNome()." - ".$this->getEmail();        
        return $str;
    }

    abstract public function inserir():Bool;

    public static function listar($tipo=0, $info=''):Array {
        $sql = "SELECT * FROM usuario";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id;"; break; // filtro por ID
            case 2: $sql .= " WHERE nome like :info ORDER BY nome;"; $info = '%'.$info.'%'; break; // filtro por nome
            case 3: $sql .= " WHERE matricula = :info ORDER BY id;"; break; // filtro por matricula
            case 4: $sql .= " WHERE tipo = :info ORDER BY id;"; break; // filtro por tipo
        }
        $parametros = array();
        if ($tipo > 0) {
            $parametros = [':info'=>$info];
        }
        $comando = Database::executar($sql, $parametros);
        $usuarios = [];
        while ($registro = $comando->fetch()) {
            if ($registro['tipo'] == 'Professor') {
                $usuario = new Professor($registro['id'], $registro['nome'], $registro['email'], $registro['senha'], $registro['matricula'], $registro['contato'], $registro['salario']);
            } else {
                $usuario = new Aluno($registro['id'], $registro['nome'], $registro['email'], $registro['senha'], $registro['matricula'], $registro['contato'], $registro['nomeResponsavel']);
            }
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    abstract public function alterar():Bool;

    public function excluir():Bool {
        $sql = "DELETE FROM usuario
                WHERE id = :id;";
        $parametros = array(':id'=>$this->getId());
        return Database::executar($sql, $parametros) == true;
    }
}
?>