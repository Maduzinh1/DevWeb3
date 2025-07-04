<?php
require_once ("Usuario.class.php");
require_once ("Database.class.php");
require_once ("Professor.class.php");
require_once ("Aluno.class.php");

class Login {
    public static function efetuarLogin($login, $senha) {
        if ($login != ""  && $senha != "") {
            $sql = "SELECT * FROM usuario
                    WHERE email = :login AND senha = :senha;";
            $parametros = array(":login"=> $login, 
                                ":senha"=> $senha);    
            try {
                $resultado = Database::executar($sql, $parametros);
                $dados = $resultado->fetch();
                if ($dados['salario']) {
                    return new Professor($dados['id'],
                                         $dados['nome'],
                                         $dados['email'],
                                         $dados['senha'],
                                         $dados['matricula'],
                                         $dados['contato'],
                                         $dados['salario']);
                } elseif ($dados['nomeResponsavel']) {
                    return new Aluno($dados['id'],
                                     $dados['nome'],
                                     $dados['email'],
                                     $dados['senha'],
                                     $dados['matricula'],
                                     $dados['contato'],
                                     $dados['nomeResponsavel']);
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erro ao consultar dados, verifique os dados informados.");
            }
        } else { 
            throw new Exception("Informe um usuário e senha válidos");
        }
    }
}
?>