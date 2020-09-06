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
<div id="app">
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-3 m-2 ">
                    <h4 class="text-dark font-weight-normal text-center">Bienvenu dans <br /><span class="font-weight-bold text-center">IRISI-APP</span></h4>
                  
                    <br/>
                    <p class="text-muted text-center">Avant commencer,vous devez vous connecter ou bien inscrivez vous si vous n'avez pas un compte.</p>
                    <br/>
                    
                    
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                    @csrf  
                    <div class="form-group">
                    
                            <label for="email">Email</label>
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  type="email" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                            </div>
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  type="password" required autofocus>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Se souvenir de Moi</label>
                            </div>
                        </div>

                        <div class="form-group text-center">
 
                            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right " tabindex="4">
                                Connecter
                            </button>
                        </div>

                        <div class="mt-5 text-center">
                            Vous n'avez pas un compte? <a href="{{route('check.show')}}">Vous pouvez le créer ici</a>
                        </div>
                    </form>

                    <div class="text-center mt-5 text-small">
                        Copyright &copy; IRISI-APP. Made with 💙 by Mery & Chaima

                    </div>
                </div>
            </div>
            <div class=" login col-lg-8 col-12  min-vh-100 background-walk-y position-relative overlay-gradient-bottom ">

                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-5 pb-2">
                        <div class="mb-5 pb-3">
                            <h1 class="mb-2 display-4 font-weight-bold">Bienvenu,</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

 
    

@endsection