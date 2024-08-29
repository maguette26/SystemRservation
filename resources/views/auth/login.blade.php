@extends('frontend.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-light rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top">
                    <h4 class="mb-0">Connexion - SenReserv Events</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Adresse e-mail') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">{{ __('Se souvenir de moi') }}</label>
                            {{-- </div>
                            <a href="{{ url('password/reset') }}" class="text-primary">{{ __('Mot de passe oublié?') }}</a>
                        </div> --}}

                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Connexion') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
