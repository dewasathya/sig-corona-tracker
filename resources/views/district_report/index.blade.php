@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h2 class="float-left mb-2">Tabel Laporan</h2>
                    <a class="btn btn-primary float-right mb-2" href="{{route('report.create')}}" role="button">Tambah Kabupaten</a>
                    <table class="table table-stripped">
                        <thead class="thead-primary">
                            <tr role="row">
                                <th rowspan="1" colspan="1" class="text-center">Tanggal</th>
                                <th rowspan="1" colspan="1" class="text-center">Kabupaten</th>
                                <th rowspan="1" colspan="6" class="text-center">Positif</th>
                                <th rowspan="1" colspan="1" class="text-center">Dirawat</th>
                                <th rowspan="1" colspan="1" class="text-center">Sembuh</th>
                                <th rowspan="1" colspan="1" class="text-center">Meninggal</th>
                                <th rowspan="1" colspan="1" class="text-center">Aksi</th>
                            </tr>
                            <tr role="row">
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="2" class="text-center">PPLN</th>
                                <th rowspan="1" colspan="1" class="text-center">PPDN</th>
                                <th rowspan="1" colspan="1" class="text-center">Transmisi Lokal</th>
                                <th rowspan="1" colspan="1" class="text-center">Positif Lainnya</th>
                                <th rowspan="1" colspan="1" class="text-center">Total Positif</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                            </tr>
                            <tr role="row">
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1" class="text-center">WNA</th>
                                <th rowspan="1" colspan="1" class="text-center">WNI</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                                <th rowspan="1" colspan="1">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            @foreach($reports as $report)
                            <tr>
                                <td class="text-center">{{ date('d-m-Y', strtotime($report->report_date)) }}</td>
                                <td class="text-center">{{$report->district_name}}</td>
                                <td class="text-center">{{$report->foreign_travel_agent_foreign}}</td>
                                <td class="text-center">{{$report->foreign_travel_agent_indonesian}}</td>
                                <td class="text-center">{{$report->domestic_travel_agent}}</td>
                                <td class="text-center">{{$report->local_transmission}}</td>
                                <td class="text-center">{{$report->other_positive}}</td>
                                <td class="text-center">{{$report->total_positive}}</td>
                                <td class="text-center">{{$report->treated}}</td>
                                <td class="text-center">{{$report->recovered}}</td>
                                <td class="text-center">{{$report->died}}</td>
                                <td>
                                    <!--<a href="{{ route('report.edit', [$report->id]) }}" class="btn btn-xs btn-primary">Ubah</a>-->
                                    <a href="{{ route('report.edit', $report->id) }}" class="btn btn-xs btn-primary">Ubah</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection