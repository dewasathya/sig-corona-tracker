@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Laporan') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('report.store')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="report_date" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <!--<input id="report_date" type="date" min="0" class="form-control @error('report_date') is-invalid @enderror" name="report_date" value="{{ old('report_date') }}" required autocomplete="report_date" autofocus>-->
                                <input id="report_date" type="date" min="0" class="form-control @error('report_date') is-invalid @enderror" name="report_date" value="2020-04-01" required autocomplete="report_date" autofocus>

                                @error('report_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('Kabupaten') }}</label>

                            <div class="col-md-6">
                                <!--<input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}" required autocomplete="district" autofocus>-->

                                <select class="form-control @error('district') is-invalid @enderror" name="district">
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">
                                        {{ $district->district_name}}
                                    </option>
                                    @endforeach
                                </select>

                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foreign_travel_agent_foreign" class="col-md-4 col-form-label text-md-right">{{ __('PPLN - WNA') }}</label>

                            <div class="col-md-6">
                                <input id="foreign_travel_agent_foreign" type="number" min="0" class="form-control @error('foreign_travel_agent_foreign') is-invalid @enderror" name="foreign_travel_agent_foreign" value="{{ old('foreign_travel_agent_foreign') }}" required autocomplete="foreign_travel_agent_foreign" autofocus>

                                @error('foreign_travel_agent_foreign')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foreign_travel_agent_indonesian" class="col-md-4 col-form-label text-md-right">{{ __('PPLN - WNI') }}</label>

                            <div class="col-md-6">
                                <input id="foreign_travel_agent_indonesian" type="number" min="0" class="form-control @error('foreign_travel_agent_indonesian') is-invalid @enderror" name="foreign_travel_agent_indonesian" value="{{ old('foreign_travel_agent_indonesian') }}" required autocomplete="foreign_travel_agent_indonesian" autofocus>

                                @error('foreign_travel_agent_indonesian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="domestic_travel_agent" class="col-md-4 col-form-label text-md-right">{{ __('PPDN') }}</label>

                            <div class="col-md-6">
                                <input id="domestic_travel_agent" type="number" min="0" class="form-control @error('domestic_travel_agent') is-invalid @enderror" name="domestic_travel_agent" value="{{ old('domestic_travel_agent') }}" required autocomplete="domestic_travel_agent" autofocus>

                                @error('domestic_travel_agent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="local_transmission" class="col-md-4 col-form-label text-md-right">{{ __('Tranmisi Lokal') }}</label>

                            <div class="col-md-6">
                                <input id="local_transmission" type="number" min="0" class="form-control @error('local_transmission') is-invalid @enderror" name="local_transmission" value="{{ old('local_transmission') }}" required autocomplete="local_transmission" autofocus>

                                @error('local_transmission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="other_positive" class="col-md-4 col-form-label text-md-right">{{ __('Positif Lainnya') }}</label>

                            <div class="col-md-6">
                                <input id="other_positive" type="number" min="0" class="form-control @error('other_positive') is-invalid @enderror" name="other_positive" value="{{ old('other_positive') }}" required autocomplete="other_positive" autofocus>

                                @error('other_positive')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_positive" class="col-md-4 col-form-label text-md-right">{{ __('Total Positif') }}</label>

                            <div class="col-md-6">
                                <input id="total_positive" type="number" min="0" class="form-control @error('total_positive') is-invalid @enderror" name="total_positive" value="{{ old('total_positive') }}" required autocomplete="total_positive" autofocus>

                                @error('total_positive')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="treated" class="col-md-4 col-form-label text-md-right">{{ __('Dirawat') }}</label>

                            <div class="col-md-6">
                                <input id="treated" type="number" min="0" class="form-control @error('treated') is-invalid @enderror" name="treated" value="{{ old('treated') }}" required autocomplete="treated" autofocus>

                                @error('treated')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="recovered" class="col-md-4 col-form-label text-md-right">{{ __('Sembuh') }}</label>

                            <div class="col-md-6">
                                <input id="recovered" type="number" min="0" class="form-control @error('recovered') is-invalid @enderror" name="recovered" value="{{ old('recovered') }}" required autocomplete="recovered" autofocus>

                                @error('recovered')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="died" class="col-md-4 col-form-label text-md-right">{{ __('Meninggal') }}</label>

                            <div class="col-md-6">
                                <input id="died" type="number" min="0" class="form-control @error('died') is-invalid @enderror" name="died" value="{{ old('died') }}" required autocomplete="died" autofocus>

                                @error('died')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{route('report.index')}}" class="btn btn-danger">
                                    {{ __('Kembali') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah') }}
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
