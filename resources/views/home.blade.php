@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <span>{{ __('Profile') }}</span>
                        <small class="ml-1"> - {{ auth()->user()->roles[0]->name }}</small>
                    </div>

                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <a href="{{ route('edit.profile') }}" class="btn btn-warning">Edit Profile</a>
                        </div>
                        <p><Strong>Name: </Strong>{{ Auth::user()->given_name ." ". Auth::user()->surname }}</p>
                        <p><Strong>Date of
                                Birth: </Strong>{{ \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('d/m/Y') }}
                        </p>
                        <p><Strong>Telephone: </Strong>{{ Auth::user()->telephone }}</p>
                        <p><Strong>Email: </Strong>{{ Auth::user()->email }}</p>
                        @if(Auth::user()->hasRole('Parent'))
                            <p><strong>Number of Children: </strong>{{ count(Auth::user()->children) }}</p>
                            <a href="{{ route('view.children') }}">See Children</a>
                        @endif
                        @if(Auth::user()->hasRole('Swimmer'))
                            <h5 class="mt-3">Training data</h5>
                            <ul class="list-group mt-2">
                                @forelse(Auth::user()->trainings as $training)
                                    <li class="list-group-item">Training on <strong>{{ \Carbon\Carbon::parse($training->training_date)->format('d/m/Y') }}</strong> was <strong>{{ $training->performance }}</strong></li>
                                @empty
                                    <li class="list-group-item text-danger">No training data</li>
                                @endforelse
                            </ul>
                            <h5 class="mt-3">Race data</h5>
                            <ul class="list-group mt-2">
                                @forelse(Auth::user()->races as $race)
                                    <li class="list-group-item">{{ $race->pivot->points == 1 ? 'Won at' : 'Lost at' }} race on <strong>{{ \Carbon\Carbon::parse($race->race_date)->format('d/m/Y') }}</strong> for <strong>{{ $race->stage }}</strong></li>
                                @empty
                                    <li class="list-group-item text-danger">No race data</li>
                                @endforelse
                            </ul>
                        @endif
                        @if(Auth::user()->hasRole('Coach'))
                            <a href="{{ route('view.squad') }}">View Squad</a>
                        @endif
                        @if(Auth::user()->hasRole('Club Administrator'))
                            <a href="{{ route('add.raceresult') }}">Add Race Result</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
