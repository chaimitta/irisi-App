@extends('layouts.app')

@section('content')

    <section id="hero" class="wow fadeIn">
        <div class="hero-container">
            <h1>Bienvenue sur IRISI-App</h1>
            <h2>Une application destinée aux élèves ingénieurs en Réseaux et Systèmes d'Information</h2>
            <img src="img/hero-img.png" alt="Hero Imgs">
            <a href="{{ route('register') }}" class="btn-get-started scrollto">Commencer</a>
        </div>
    </section>
    <footer >
        <div class="container-fluid">
            <div class="row">
                <div class="credits ml-auto">
                <span class="copyright">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>{{ __(', made with love ') }}<i class="fa fa-heart heart"></i>{{ __(' by Chaimaa and Meriem ') }}
                </div>
            </div>
        </div>
    </footer>
@endsection
