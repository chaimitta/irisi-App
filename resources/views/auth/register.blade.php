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
            <div class="login-brand">
                <h3 style="color: #fff;"><span style="color: #fff;">Bienvenu</span> {{Session::get('nom')}}<span style="color: #fff;">,</span></h3>
                 
             </div>

                <div class="inscription card card-primary">
                    <div class="card-header text-center">
                        <h4 class="text-center">Maintenant veuillez créer votre compte</h4>
                    </div>

                    <div class="card-body ">

                        <form method="POST" class="needs-validation" action="{{ route('register') }}" novalidate>


                            @csrf
                            <div class="row">

                                <div class="form-group col-12 ">



                                    <label for="email">E-mail</label>

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    </div>

                                    </div>



                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password">Mot de passe</label>


                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password-confirm">Confirmer mot de passe</label>


                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">


                                        </div>

                                    </div>
                                   
                                    <div class="row"> 
                                        <label for="tel">Téléphone</label>

                                        <div class="col-md-12">
                                            <input id="tel" type="tel" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel" autofocus>

                                            @error('tel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror</div>
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