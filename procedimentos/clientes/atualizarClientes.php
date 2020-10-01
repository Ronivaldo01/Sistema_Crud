<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/clientes.php";



$obj = new clientes();



$dados=array(
	$_POST['id'],
	$_POST['nomeU'],
	$_POST['sobrenomeU'],
	$_POST['nascimentoU'],
	$_POST['sexoU'],
	$_POST['cpfU'],
	$_POST['rgU']
	

);

echo $obj->atualizarCliente($dados);

 ?>