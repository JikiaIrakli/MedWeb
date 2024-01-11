@extends('layout')
@section('title','Submit Patient')
@section('content')


    <div class="container">

        <div class="card">
            <div class="px-3 pt-4 pb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                            src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario" alt="Mario Avatar">
                        <div>
                            <h3 class="card-title mb-0"><a> {{auth()->user()->name}}
                                </a></h3>
                            
                        </div>
                    </div>
                </div>
                <div class="px-2 mt-4">
                    <h5 class="fs-5"> About : </h5>
                    <p class="fs-6 fw-light">
                        Hello Its me {{auth()->user()->name}} !!!
                    </p>
                    <div class="d-flex justify-content-start">
                        <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                            </span> Email: {{auth()->user()->email}}</a>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary btn-sm"> Edit </button>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
    