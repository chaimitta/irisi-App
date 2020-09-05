@extends('layouts.app')

@section('content')
<
    <br><br>
    <div class="content">
        <div class="container">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            @if(isset($messageErr))
              <div class="alert alert-danger alert-dismissible fade show text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Erreur:</strong> {{$messageErr}}
                                </div>
            @endif
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login">
                        <div class="card-header ">
                            <div class="card-header ">
                                <h3 class="header text-center" style="color: orange">Connectez vous</h3>
                            </div>
                        </div>
                        <div class="card-body ">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Mot de passe') }}" type="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="remember" type="checkbox" value="" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-sign"></span>
                                        {{ __('Rester connecté') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block btn">{{ __('Connexion') }}</button>
                        </div>
                    </div>
                    <br>@if (Route::has('password.request'))
                                <a  href="{{ route('password.request') }}" style="color: green">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                </form>
            </div>
        </div>
    </div>

@endsection



