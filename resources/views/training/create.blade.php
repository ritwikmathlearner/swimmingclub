@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('store.training') }}">
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
                                <label for=user_id" class="col-md-4 col-form-label text-md-right">{{ __('Member') }}</label>

                                <div class="col-md-6">
                                    <select name="user_id" id=user_id" class="form-control" required>
                                        <option value="">Select Team Member</option>
                                        @foreach($teamMembers as $member)
                                            <option value="{{ $member->id }}">{{ $member->given_name ." ". $member->surname }}</option>
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
                                <label for="performance" class="col-md-4 col-form-label text-md-right">{{ __('Performance') }}</label>

                                <div class="col-md-6">
                                    <select name="performance" id=performance" class="form-control" required>
                                        <option value="">Select Performance Type</option>
                                        <option value="Bad">Bad</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Good">Good</option>
                                    </select>
                                    @error('performance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="training_date" class="col-md-4 col-form-label text-md-right">{{ __('Training Date') }}</label>

                                <div class="col-md-6">
                                    <input id="training_date" type="date" class="form-control @error('training_date') is-invalid @enderror" name="training_date" value="{{ old('training_date') }}" required autocomplete="training_date" autofocus>

                                    @error('training_date')
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
