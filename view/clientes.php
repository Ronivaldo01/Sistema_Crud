<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>clientes</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmClientes">
						<label>Nome</label>
						<input type="text" class="form-control input-sm" id="nome" name="nome">
						<label>Sobrenome</label>
						<input type="text" class="form-control input-sm" id="sobrenome" name="sobrenome">
						<label>Nascimento</label>
						<input type="date" class="form-control input-sm" id="nascimento" name="nascimento">
						
							<p></p>
							<div class="form-check">
							<div><label>Sexo</label></div>
							<input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M">
								<label class="form-check-label" for="sexoM">
									Masculino
								</label>
								<input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F" checked>
								<label class="form-check-label" for="sexoF">
									Feminino
								</label>
							</div>
							<p></p>
						
						<label>CPF</label>
						<input type="text" class="form-control input-sm" id="cpf" name="cpf">
						<label>RG</label>
						<input type="text" class="form-control input-sm" id="rg" name="rg">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarCliente">Salvar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaClientesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="id" name="id">
							<label>Nome</label>
							<input type="text" class="form-control input-sm" id="nomeU" name="nomeU">
							<label>Sobrenome</label>
							<input type="text" class="form-control input-sm" id="sobrenomeU" name="sobrenomeU">
							<label>Nascimento</label>
							<input type="date" class="form-control input-sm" id="nascimentoU" name="nascimentoU"/>
							<label>Sexo</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="sexoU" id="sexomU" value="M">
								<label class="form-check-label" for="sexomU">
									Masculino
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="sexoU" id="sexofU" value="F" checked>
								<label class="form-check-label" for="sexofU">
									Feminino
								</label>
							</div>
							
							<label>CPF</label>
							<input type="text" class="form-control input-sm" id="cpfU" name="cpfU">
							<label>RG</label>
							<input type="text" class="form-control input-sm" id="rgU" name="rgU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(id){

			$.ajax({
				type:"POST",
				data:"id=" + id,
				url:"../procedimentos/clientes/obterDadosCliente.php",
				success:function(r){

					dado=jQuery.parseJSON(r);


					$('#idclienteU').val(dado['id']);
					$('#nomeU').val(dado['nome']);
					$('#sobrenomeU').val(dado['sobrenome']);
					$('#nascimentoU').val(dado['nascimento']);
					$('#sexoU').val(dado['sexo']);
					$('#cpfU').val(dado['cpf']);
					$('#rgU').val(dado['rg']);



				}
			});
		}

		function eliminarCliente(idcliente){
			alertify.confirm('Deseja Excluir este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procedimentos/clientes/eliminarClientes.php",
					success:function(r){


						if(r==1){
							$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");
							alertify.success("Excluido com sucesso!!");
						}else{
							alertify.error("Não foi possível excluir");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");

			$('#btnAdicionarCliente').click(function(){

				vazios=validarFormVazio('frmClientes');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmClientes').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/clientes/adicionarClientes.php",
					success:function(r){

						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");
							alertify.success("Cliente Adicionado");
						}else{
							alertify.error("Não foi possível adicionar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAdicionarClienteU').click(function(){
				dados=$('#frmClientesU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/clientes/atualizarClientes.php",
					success:function(r){



						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");
							alertify.success("Cliente atualizado com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar cliente");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>