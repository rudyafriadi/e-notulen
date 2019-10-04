<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Notulen</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Data Notulen</h4>
		{{-- <h6><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5> --}}
	</center>
	<center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Rapat</th>
				<th>Tanggal Entri</th>
				<th>Agenda Rapat</th>
				<th>Jenis Rapat</th>
				<th>Notulius</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
                @php $i=1 @endphp
                @foreach ($notulen as $data)
                <tr>
					<td>{{$i++}}</td>
					<td>{{$data->tanggal}}</td>
					<td>{{$data->created_at}}</td>
					<td>{{$data->agenda_rapat}}</td>
					<td>{{$data->j_rapat}}</td>
					<td>{{$data->users_id}}</td>
					<td>{{$data->status}}</td>
                </tr>
                @endforeach
		</tbody>
	</table>
</center>
</body>
</html>