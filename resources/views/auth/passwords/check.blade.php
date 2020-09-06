@extends('layouts.app')
@section('login_styles')
<!-- General CSS Files -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
<link rel="stylesheet" href="node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
<link rel="stylesheet" href="node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">

<link rel="stylesheet" href="assets2/css/style.css">
<link rel="stylesheet" href="assets2/css/components.css">
<link rel="stylesheet" href="assets2/css/your_style.css">

@endsection
@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">


                <div class="inscription card card-primary">
                    <div class="card-header text-center">
                        <h4 class="text-center">Veuillez vous identifier</h4>
                    </div>

                    <div class="card-body ">
                        <form method="POST" class="needs-validation" action="{{ url('/check') }}" novalidate>
                            @if(isset($message_error))
                            <div class="alert alert-danger alert-dismissible fade show text-center">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Erreur:</strong> {{$message_error}}
                            </div>
                            @endif
                            @if(isset($message_error2))
                            <div class="alert alert-danger alert-dismissible fade show text-center">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Erreur:</strong> {{$message_error2}}
                            </div>
                            @endif
                            @csrf
                            <div class="row">

                                <div class="form-group col-12 ">
                                    <label for="first_name">CNE</label>
                                    <input id="cne" type="text" class="form-control @error('cne') is-invalid @enderror" name="cne" value="{{ old('cne') }}" required autocomplete="cne" autofocus>

                                    @error('cne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group col-12">
                                    <label for="last_name">Code Apogee</label>
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row">

                                <div class="form-group col-12">
                                    <label for="email">Date de Naissance</label>
                                    <input id="dateBirth" type="date" class="form-control @error('dateBirth') is-invalid @enderror" name="dateBirth" value="{{ old('dateBirth') }}" required autocomplete="dateBirth" autofocus>

                                    @error('dateBirth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

<br>
<br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Poursuivre
                                </button>
                            </div>
                            <div class="text-center mt-5 text-small">
                        Copyright &copy; IRISI-APP. Made with 💙 by Mery & Chaima

                    </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script src="{{asset('assets2/js/page/auth-register.js')}}"></script>
<script>
    $('.menu-active').removeClass('menu-active');
    $('#inscription').addClass('menu-active');
</script>
@endsection