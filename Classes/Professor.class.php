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
        $sql = "INSERT INTO Usuario (nome, email, senha, matricula, contato, tipo, salario)
                VALUES (:nome, :email, :senha, :matricula, :contato, :tipo, :salario);";
        $parametros = array(':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato(),
                            ':tipo'=>$this->getTipo(),
                            ':salario'=>$this->getSalario());
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array {
        $sql = "SELECT * FROM usuario";
        switch ($tipo){
            case 0: $sql .= " WHERE tipo = 'Professor' ORDER BY id;"; break; // sem filtro
            case 1: $sql .= " WHERE id = :info AND tipo = 'Professor' ORDER BY id;"; break; // filtro por ID
            case 2: $sql .= " WHERE nome like :info AND tipo = 'Professor' ORDER BY nome;"; $info = '%'.$info.'%'; break; // filtro por nome
            case 3: $sql .= " WHERE matricula = :info AND tipo = 'Professor' ORDER BY id;"; break; // filtro por matricula
            case 4: $sql .= " WHERE tipo = 'Professor' ORDER BY id;"; break; // filtro por tipo
        }
        $parametros = array();
        if ($tipo > 0 && $tipo != 4) {
            $parametros = [':info'=>$info];
        }
        $comando = Database::executar($sql, $parametros);
        $usuarios = [];
        while ($registro = $comando->fetch()) {
            $usuario = new Professor($registro['id'], $registro['nome'], $registro['email'], $registro['senha'], $registro['matricula'], $registro['contato'], $registro['salario']);
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