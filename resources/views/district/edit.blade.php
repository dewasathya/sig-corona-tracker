@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ubah Kabupaten') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('district.update', $dis->id)}}">
                        <input name="_method" type="hidden" value="PATCH"/>
                        @csrf

                        <input type="hidden" id="id" name="id" value="{{ $dis->id}}" />

                        <div class="form-group row">
                            <label for="district_name" class="col-md-4 col-form-label text-md-right">{{ __('Kabupaten') }}</label>

                            <div class="col-md-6">
                                <input id="district_name" type="text" class="form-control @error('district_name') is-invalid @enderror" name="district_name" value="{{ $dis->district_name }}" required autocomplete="district_name" autofocus>

                                @error('district_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{route('district.index')}}" class="btn btn-danger">
                                    {{ __('Kembali') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ubah') }}
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
