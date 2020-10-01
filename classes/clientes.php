<?php 

class clientes{
	public function adicionarCliente($dados){
	
		
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "INSERT INTO clientes (nome, sobrenome, nascimento, sexo, cpf, rg) VALUES ('$dados[0]', '$dados[1]', 
		   '$dados[2]',
		   '$dados[3]',
			'$dados[4]',
			'$dados[5]'
			)";

			//var_dump($sql);

		return mysqli_query($conexao, $sql); 
	}




	public function obterDadosCliente($id){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id, nome, sobrenome, nascimento, sexo, cpf, rg from clientes where id='$id' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id' => $mostrar[0],
				'nome' => $mostrar[1],
				'sobrenome' => $mostrar[2],
				'nascimento' => $mostrar[3],
				'sexo' => $mostrar[4],
				'cpf' => $mostrar[5],
				'rg' => $mostrar[6],
			);

			return $dados;

	}


	public function atualizarCliente($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE clientes SET nome = '$dados[1]', sobrenome = '$dados[2]',nascimento = '$dados[3]',sexo = '$dados[4]',cpf = '$dados[5]',rg = '$dados[6]' where id = '$dados[0]'";


		echo mysqli_query($conexao, $sql);
	}


	public function excluirCliente($id){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from clientes where id = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>