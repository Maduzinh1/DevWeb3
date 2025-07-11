<?php
session_start();
require_once ('../valida_login.php');
require_once ("../Classes/Form.class.php");
require_once ("../Classes/Disciplina.class.php");
require_once ("../Classes/Professor.class.php");
require_once ("../Classes/Aluno.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id'])?$_POST['id']:0;
    $nome = isset($_POST['nome'])?$_POST['nome']:"";
    $idProfessor = isset($_POST['idProfessor'])?$_POST['idProfessor']:0;
    $acao = isset($_POST['acao'])?$_POST['acao']:"";

    $disciplina = new Disciplina($id, $nome, $idProfessor);
    if ($acao == 'salvar') {
        if ($id > 0) {
            $resultado = $disciplina->alterar();
        } else {
            $resultado = $disciplina->inserir();
        }
    } elseif ($acao == 'excluir') {
        $resultado = $disciplina->excluir();
    }

    if ($resultado) {
        header("Location: index.php");
    } else {
        echo "Erro ao salvar dados: ". $disciplina;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $formulario = file_get_contents('form_cad_disciplina.html');

    $id = isset($_GET['id'])?$_GET['id']:0;
    $resultado = Disciplina::listar(1, $id);
    if ($resultado) {
        $usuario = $resultado[0];
        $professores = Form::montaSelect(Professor::listar(4, "Professor"), 'idProfessor', "", 0);
        $formulario = str_replace('{id}', $usuario->getId(), $formulario);
        $formulario = str_replace('{nome}', $usuario->getNome(), $formulario);
        $formulario = str_replace('{professor}', $professores, $formulario);
    } else {
        $professores = Form::montaSelect(Professor::listar(4, "Professor"), 'idProfessor', "", 0);
        $formulario = str_replace('{id}', 0, $formulario);
        $formulario = str_replace('{nome}', '', $formulario);
        $formulario = str_replace('{professor}', $professores, $formulario);
    }
    print($formulario);
}
?>