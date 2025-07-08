<?php
session_start();
require_once ('../valida_login.php');
require_once ("../Classes/Professor.class.php");
require_once ("../Classes/Aluno.class.php");
require_once ("../Classes/Form.class.php");
    
$busca = isset($_GET['busca'])?$_GET['busca']:0;
$tipo = isset($_GET['tipo'])?$_GET['tipo']:4;
$qualUsuario = isset($_GET['qual_usuario'])?$_GET['qual_usuario']:0;

$itensProfessores = '';
if ($qualUsuario == 1) {
    $listaProfessores = Professor::listar($tipo, $busca);
} else {
    $listaProfessores = Professor::listar(4, 0);
}
foreach($listaProfessores as $professor) {
    $item = file_get_contents('itens_listagem_professores.html');
    $item = str_replace('{id}', $professor->getId(), $item);
    $item = str_replace('{nome}', $professor->getNome(), $item);
    $item = str_replace('{email}', $professor->getEmail(), $item);
    $item = str_replace('{senha}', $professor->getSenha(), $item);
    $item = str_replace('{matricula}', $professor->getMatricula(), $item);
    $item = str_replace('{contato}', $professor->getContato(), $item);
    $item = str_replace('{tipo}', 'Professor', $item);
    $item = str_replace('{salario}', $professor->getSalario(), $item);
    $itensProfessores .= $item;
}

$itensAlunos = '';
if ($qualUsuario == 2) {
    $listaAlunos = Aluno::listar($tipo, $busca);
} else {
    $listaAlunos = Aluno::listar(4, 0);
}
foreach($listaAlunos as $aluno) {
    $item = file_get_contents('itens_listagem_alunos.html');
    $item = str_replace('{id}', $aluno->getId(), $item);
    $item = str_replace('{nome}', $aluno->getNome(), $item);
    $item = str_replace('{email}', $aluno->getEmail(), $item);
    $item = str_replace('{senha}', $aluno->getSenha(), $item);
    $item = str_replace('{matricula}', $aluno->getMatricula(), $item);
    $item = str_replace('{contato}', $aluno->getContato(), $item);
    $item = str_replace('{tipo}', 'Aluno', $item);
    $item = str_replace('{nomeResponsavel}', $aluno->getNomeResponsavel(), $item);
    $itensAlunos .= $item;
}

$listagem = file_get_contents('listagem_usuario.html');
$listagem = str_replace('{itens_professores}', $itensProfessores, $listagem);
$listagem = str_replace('{itens_alunos}', $itensAlunos, $listagem);
print($listagem);
?>