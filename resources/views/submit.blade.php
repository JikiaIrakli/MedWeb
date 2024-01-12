@extends('layout')
@section('title', 'Submit Patient')
@section('content')

<div class="container">

    <div class="mt-5">
        @if($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if (session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
    </div>

    <div class="mt-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            @if(session('patient'))
                <p>Name: {{ session('patient')->name }}</p>
                <p>ID Number: {{ session('patient')->id_number }}</p>
                <p>Phone: {{ session('patient')->phone }}</p>
                <p>Research Interests:</p>
                <ul>
                    @foreach(session('patient')->research_interests as $research)
                        <li>{{ $research }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        @endif
    </div>

    <form action="{{ route('submit.post') }}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
        @csrf
        <div class="col-md-auto">
            <h4>Fill The Form: </h4>

            <div class="mb-3">
                <h5><label for="name" class="form-label">Full Name:</label></h5>
                <input type="name" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <h5><label for="id_number" class="form-label">ID:</label></h5>
                <input type="number" class="form-control" name="id_number">
            </div>
            <div class="mb-3">
                <h5><label for="phone" class="form-label">Phone:</label></h5>
                <input type="tel" class="form-control" name="phone">
            </div>
            <div class="mb-3">
                <h5><label for="researches" class="form-label">Research Interests:</label></h5>
                <select name="researches[]" multiple class="form-control">
                    
                    @foreach($researches as $research)
                        <option value="{{ $research->id }}">{{ $research->name }}</option>
                    @endforeach
                    
                </select>
            </div>

            <button type="submit" class="button-29">Submit!</button>
        </div>
    </form>

</div>
@endsection