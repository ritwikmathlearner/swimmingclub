@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('store.raceresult') }}">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for=race_id" class="col-md-4 col-form-label text-md-right">{{ __('Stage') }}</label>

                                <div class="col-md-6">
                                    <select name="race_id" id=race_id" class="form-control" required>
                                        <option value="">Select Race Stage</option>
                                        @foreach($races as $race)
                                            <option value="{{ $race->id }}">{{ $race->stage }}</option>
                                        @endforeach
                                    </select>

                                    @error('race_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Participants') }}</label>

                                <div class="col-md-6">
                                    <select name="user_id" id=user_id" class="form-control" required>
                                        <option value="">Select Participant</option>
                                        @foreach($participants as $participant)
                                            <option value="{{ $participant->id }}">{{ $participant->given_name . ' '. $participant->surname }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="points" class="col-md-4 col-form-label text-md-right">{{ __('Participants') }}</label>

                                <div class="col-md-6">
                                    <select name="points" id=points" class="form-control" required>
                                        <option value="1">Own</option>
                                        <option value="0">Lost</option>
                                    </select>
                                    @error('points')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
