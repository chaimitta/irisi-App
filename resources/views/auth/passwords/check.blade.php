@extends('layouts.app')

@section('content')
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" ><i>Veuillez vous identifier</i></div>

                    <div class="card-body">
                        <form method="POST" class="needs-validation" action="{{ url('/check') }}" novalidate>
                            @if(isset($message_error))
                                <div class="alert alert-danger alert-dismissible fade show text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Erreur:</strong> {{$message_error}}
                                </div>
                            @endif
                            @csrf
                            <div class="form-group row">
                                <label for="cne" class="col-md-4 col-form-label text-md-right">CNE</label>
                                <div class="col-md-6">
                                    <input id="cne" type="text" class="form-control @error('cne') is-invalid @enderror" name="cne" value="{{ old('cne') }}" required autocomplete="cne" autofocus>

                                    @error('cne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">Code Apogée</label>
                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dateBirth" class="col-md-4 col-form-label text-md-right">Date de naissance</label>
                                <div class="col-md-6">
                                    <input id="dateBirth" type="date" class="form-control @error('dateBirth') is-invalid @enderror" name="dateBirth" value="{{ old('dateBirth') }}" required autocomplete="dateBirth" autofocus>

                                    @error('dateBirth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Poursuivre
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.menu-active').removeClass('menu-active');
        $('#inscription').addClass('menu-active');
    </script>
@endsection
