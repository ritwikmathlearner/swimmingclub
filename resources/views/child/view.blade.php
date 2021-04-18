@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Children') }}</div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <a href="{{ route('create.children') }}" class="btn btn-success">Add Child</a>
                            <a href="/home" class="btn btn-dark ml-auto">Profile</a>
                        </div>
                        @forelse(Auth::user()->children as $child)
                            <div class="w-100 border p-2">
                                <h4>{{ $child->given_name ." ". $child->surname }}</h4>
                                <p>{{ \Carbon\Carbon::parse($child->date_of_birth)->format('d/m/Y') }}</p>
                                <h5 class="mt-3">Training data</h5>
                                <ul class="list-group mt-2">
                                    @forelse($child->trainings as $training)
                                        <li class="list-group-item">Training on <strong>{{ \Carbon\Carbon::parse($training->training_date)->format('d/m/Y') }}</strong> was <strong>{{ $training->performance }}</strong></li>
                                    @empty
                                        <li class="list-group-item text-danger">No training data</li>
                                    @endforelse
                                </ul>
                                <h5 class="mt-3">Race data</h5>
                                <ul class="list-group mt-2">
                                    @forelse($child->races as $race)
                                        <li class="list-group-item">{{ $race->pivot->points == 1 ? 'Won at' : 'Lost at' }} race on <strong>{{ \Carbon\Carbon::parse($race->race_date)->format('d/m/Y') }}</strong> for <strong>{{ $race->stage }}</strong></li>
                                    @empty
                                        <li class="list-group-item text-danger">No race data</li>
                                    @endforelse
                                </ul>
                            </div>
                        @empty
                            <p class="text-danger">No children</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
