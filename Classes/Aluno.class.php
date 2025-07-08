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
        $sql = "INSERT INTO Usuario (nome, email, senha, matricula, contato, tipo, nomeResponsavel)
                VALUES (:nome, :email, :senha, :matricula, :contato, :tipo, :nomeResponsavel);";
        $parametros = array(':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato(),
                            ':tipo'=>$this->getTipo(),
                            ':nomeResponsavel'=>$this->getNomeResponsavel());
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array {
        $sql = "SELECT * FROM usuario";
        switch ($tipo){
            case 0: $sql .= " WHERE tipo = 'Aluno' ORDER BY id;"; break; // sem filtro
            case 1: $sql .= " WHERE id = :info AND tipo = 'Aluno' ORDER BY id;"; break; // filtro por ID
            case 2: $sql .= " WHERE nome like :info AND tipo = 'Aluno' ORDER BY nome;"; $info = '%'.$info.'%'; break; // filtro por nome
            case 3: $sql .= " WHERE matricula = :info AND tipo = 'Aluno' ORDER BY id;"; break; // filtro por matricula
            case 4: $sql .= " WHERE tipo = 'Aluno' ORDER BY id;"; break; // filtro por tipo
        }
        $parametros = array();
        if ($tipo > 0 && $tipo != 4) {
            $parametros = [':info'=>$info];
        }
        $comando = Database::executar($sql, $parametros);
        $usuarios = [];
        while ($registro = $comando->fetch()) {
            $usuario = new Aluno($registro['id'], $registro['nome'], $registro['email'], $registro['senha'], $registro['matricula'], $registro['contato'], $registro['nomeResponsavel']);
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