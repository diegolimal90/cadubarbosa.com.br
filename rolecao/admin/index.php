<?php
require_once '../php/efetuar-login.php';


if(!isset($_SESSION['nome'])){
	//remove as variaveis da sessao(caso elas existam)
	unset($_SESSION['nome'], $_SESSION['usuarioLogin']);

	session_destroy();
	//manda para a tela de login
	echo "<script language='javascript' type='text/javascript'>window.location.href='../login.html';</script>";
}

$sql = "SELECT * FROM rolecao";
$query = $con->query($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Painel Relatório Inscritos</title>

<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" />
<link rel="stylesheet" href="../assets/styles/css/estilo_adm.css" />

<link href="../assets/scripts/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/scripts/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/scripts/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/scripts/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">

<script type="text/javascript" src="../assets/scripts/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
</head>

<body>
<div class="page-header">
    <nav class="navbar navbar-default">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>-->
		  <a class="navbar-brand" href="index.php"><h1 style="line-height:0px">Relatório Rolê-cão</h1></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav navbar-right">
			  <li role="presentation" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['nome']; ?> <span class="caret"></span> </a>
				<ul class="dropdown-menu">
				  <!--<li><a href="#">Action</a></li>
				  <li><a href="#">Another action</a></li>
				  <li><a href="#">Something else here</a></li>-->
				  <li role="separator" class="divider"></li>
				  <li><a href="../php/logoff.php">Sair</a></li>
				</ul>
			  </li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Relatório de Cadastro</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
							<table id="datatable-buttons" class="table table-responsive table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>NOME</th>
										<th>TELEFONE</th>
										<th>CELULAR</th>
										<th>EMAIL</th>
										<th>TAMANHO</th>
										<th>ENDEREÇO</th>
										<th>AMIGUINHO</th>
									</tr>
								</thead>
								<tbody>
								<?php
									while($res = $query->fetch()){
								?>
									<tr>
										<th scope="row"><?php echo $res['id_inscrito']; ?></th>
										<td><?php echo strtoupper($res['nome']); ?></td>
										<td><?php echo strtoupper($res['fone']);?></td>
										<td><?php echo strtoupper($res['cel']);?></td>
										<td><?php echo strtoupper($res['email']); ?></td>
										<td><?php echo $res['tam']; ?></td>
										<td><?php echo strtoupper($res['rua'])." ". strtoupper($res['complemento'])." - ".strtoupper($res['cep']).", ". strtoupper($res['bairro'])." - ".strtoupper($res['cidade'])  ; ?></td>
										<td><?php echo strtoupper($res['nm_animal']); ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="../assets/styles/jquery.dataTables.min.css" />
<script type="text/javascript" src="../assets/scripts/jquery.dataTables.min.js"></script>
<!-- Datatables-->
<script src="../assets/scripts/datatables/dataTables.bootstrap.js"></script>
<script src="../assets/scripts/datatables/dataTables.buttons.min.js"></script>
<script src="../assets/scripts/datatables/buttons.bootstrap.min.js"></script>
<script src="../assets/scripts/datatables/jszip.min.js"></script>
<script src="../assets/scripts/datatables/pdfmake.min.js"></script>
<script src="../assets/scripts/datatables/vfs_fonts.js"></script>
<script src="../assets/scripts/datatables/buttons.html5.min.js"></script>
<script src="../assets/scripts/datatables/buttons.print.min.js"></script>
<script src="../assets/scripts/datatables/dataTables.fixedHeader.min.js"></script>
<script src="../assets/scripts/datatables/dataTables.keyTable.min.js"></script>
<script src="../assets/scripts/datatables/dataTables.responsive.min.js"></script>
<script src="../assets/scripts/datatables/responsive.bootstrap.min.js"></script>
<script src="../assets/scripts/datatables/dataTables.scroller.min.js"></script>

<script>
	var handleDataTableButtons = function () {
			"use strict";
			0 !== $( "#datatable-buttons" ).length && $( "#datatable-buttons" ).DataTable( {
				dom: "Bfrtip",
				buttons: [ {
					extend: "copy",
					className: "btn-sm"
				}, {
					extend: "csv",
					className: "btn-sm"
				}, {
					extend: "excel",
					className: "btn-sm"
				}, {
					extend: "pdf",
					className: "btn-sm"
				}, {
					extend: "print",
					className: "btn-sm"
				} ],
				responsive: !0
			} )
		},
		TableManageButtons = function () {
			"use strict";
			return {
				init: function () {
					handleDataTableButtons()
				}
			}
		}();
</script>
<script type="text/javascript">
	$( document ).ready( function () {
		$( '#datatable' ).dataTable();
		$( '#datatable-keytable' ).DataTable( {
			keys: true
		} );
		$( '#datatable-responsive' ).DataTable();
		$( '#datatable-scroller' ).DataTable( {
			ajax: "js/datatables/json/scroller-demo.json",
			deferRender: true,
			scrollY: 380,
			scrollCollapse: true,
			scroller: true
		} );
		var table = $( '#datatable-fixed-header' ).DataTable( {
			fixedHeader: true
		} );
	} );
	TableManageButtons.init();
</script>
<script type="text/javascript">
	
	$("#relFiel").DataTable();
	
</script>
</body>
</html>