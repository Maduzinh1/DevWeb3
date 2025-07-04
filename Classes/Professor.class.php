<?PHP
require_once ("Usuario.class.php");

class Professor extends Usuario {
    private $salario;

    public function __construct($id, $nome, $email, $senha, $matricula, $contato, $salario) {
        parent::__construct($id, $nome, $email, $senha, $matricula, $contato);
        $this->setSalario($salario);
    }

    public function getSalario() {
        return $this->salario;
    }

    public function setSalario($salario) {
        if ($salario < 0) {
            throw new Exception('Erro. O salário deve ser maior ou igual a 0');
        } else {
            $this->salario = $salario;
        }
    }

    public function inserir():Bool {
        $sql = "INSERT INTO Usuario (nome, email, senha, matricula, contato, salario)
                VALUES (:nome, :email, :senha, :matricula, :contato, :salario);";
        $parametros = array(':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato(),
                            ':salario'=>$this->getSalario());
        return Database::executar($sql, $parametros) == true;
    }

    public function alterar():Bool {       
        $sql = "UPDATE usuario
                SET nome = :nome, 
                    email = :email,
                    senha = :senha,
                    matricula = :matricula,
                    contato = :contato
                    salario = :salario
                WHERE id = :id;";
        $parametros = array(':id'=>$this->getId(),
                            ':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato(),
                            ':salario'=>$this->getSalario());
        return Database::executar($sql, $parametros) == true;
    }
}

?>