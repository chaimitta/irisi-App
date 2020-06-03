@extends('layouts.app')

@section('content')
    <br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->nom}} {{$user->prenom}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenue Admin sur votre espace privé!
                </div>
            </div>
        </div>
    </div>
</div>

