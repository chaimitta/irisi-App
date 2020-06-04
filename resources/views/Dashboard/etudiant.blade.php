@extends('layouts.dashboardApp')

@section('content')
    @if(isset($modules))
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                    <div class="row pt-md-5 mt-md-3 mb-5">
                        @foreach($modules as $module)
                            <div class="col-xl-3 col-sm-6 p-2">
                                <div class="card card-common">
                                    <div class="card-body" style="min-height: 150px">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left text-secondary">
                                                <h5>{{$module->libelle}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-success">
                                        <i class="fas fa-eye mr-3"></i>
                                        <a href="#"><span class="text-success">Voir les cours</span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    @endif
@endsection
