<?PHP
require_once ("Usuario.class.php");

class Aluno extends Usuario {
    private $nomeResponsavel;

    public function __construct($id, $nome, $email, $senha, $matricula, $contato, $nomeResponsavel) {
        parent::__construct($id, $nome, $email, $senha, $matricula, $contato);
        $this->setNomeResponsavel($nomeResponsavel);
    }

    public function getNomeResponsavel() {
        return $this->nomeResponsavel;
    }

    public function setNomeResponsavel($nomeResponsavel) {
        if ($nomeResponsavel == "") {
            throw new Exception('Erro. Informe o nome do responsável.');
        } else {
            $this->nomeResponsavel = $nomeResponsavel;
        }
    }

    public function inserir():Bool {
        $sql = "INSERT INTO Usuario (nome, email, senha, matricula, contato, nomeResponsavel)
                VALUES (:nome, :email, :senha, :matricula, :contato, :nomeResponsavel);";
        $parametros = array(':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato(),
                            ':nomeResponsavel'=>$this->getNomeResponsavel());
        return Database::executar($sql, $parametros) == true;
    }

    public function alterar():Bool {       
        $sql = "UPDATE usuario
                SET nome = :nome, 
                    email = :email,
                    senha = :senha,
                    matricula = :matricula,
                    contato = :contato
                    nomeResponsavel = :nomeResponsavel
                WHERE id = :id;";
        $parametros = array(':id'=>$this->getId(),
                            ':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato(),
                            ':nomeResponsavel'=>$this->getNomeResponsavel());
        return Database::executar($sql, $parametros) == true;
    }
}

?>