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
                    <h2 class="float-left mb-2">Tabel Kabupaten</h2>
                    <a class="btn btn-primary float-right mb-2" href="{{route('district.create')}}" role="button">Tambah Kabupaten</a>
                    <table class="table table-stripped">
                        <thead class="thead-primary">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">ID</th>
                                <th>Nama Kabupaten</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            @foreach($districts as $district)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$district->id}}</td>
                                <td>{{$district->district_name}}</td>
                                <td>
                                    <!--<a href="{{ route('district.edit', [$district->id]) }}" class="btn btn-xs btn-primary">Ubah</a>-->
                                    <a href="{{ route('district.edit', $district->id) }}" class="btn btn-xs btn-primary">Ubah</a>
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