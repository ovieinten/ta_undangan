<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"/>
	<style type="text/css">
	.mrgn-top-30
	{
		margin-top: 50px;
	}
	.navbar
	{
		background-color: #367fa9;
	}

	@media print
	{
		.mrgn-top-30
		{
			margin-top: unset;
		}
	}
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="#" style="color: #fff"><b>Laporan Penjualan Undangan</b></a>
			<ul class="nav navbar-nav navbar-right">
				<li class="active">
					<a onclick="window.print()" class="btn btn-success" style="background-color: #5cb85c; color: #fff;"><b>CETAK or Save PDF</b></a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row mrgn-top-30">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<center>
					<h1>Laporan Penjualan {{ @$data->bulan ? 'Bulan '.$data->bulanMap[$data->bulan] : null}}</h1>
					<h4>Tahun : {{$data->tahun}} </h4>
				</center>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Order ID</th>
							<th>Total Penjualan</th>
							<!-- <th>Keterangan</th> -->
						</tr>
						<tbody>
						@foreach($data->report->get() as $report)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{@$report->id}}</td>
							<td>Rp{{number_format(@$report->paid_total).',-'}}</td>
							<!-- <td>Pending</td> -->
						</tr>
					
						@endforeach
						<tr>
							<td colspan="2">Jumlah</td>
							<td>Rp{{number_format($data->report->selectRaw('sum(paid_total) as query_paid_total')->first()->query_paid_total).',-'}}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 50px">
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align: right;">
						Di Ketahui Oleh, <br><br><br><br>
						<p>Ovie Inten Pertiwi</p>
						<span style="border-top: 1px solid black; padding-top: 2px;">Operator</span>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align: right;">
						Di Setuji Oleh, <br><br><br><br>
						<p>M. Maulana Zulkarnain</p>
						<span style="border-top: 1px solid black; padding-top: 2px;">Owner</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{asset('b/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>