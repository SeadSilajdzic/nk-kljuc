@extends('layouts.dashboard')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.index') }}">Početna</a> /
        </span>
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.user.index') }}">Korisnici</a> /
        </span>
        <a href="{{ route('dashboard.user.create') }}">Dodaj korisnika</a>
    </h4>

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Dodaj novog korisnika</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.user.store') }}" method="post">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="name">Ime</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name"
                                   id="name" placeholder="John Doe">
                            @error('name') <spam class="text-danger">{{ $message }}</spam>  @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="email">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="email" value="{{ old('email') }}" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror" placeholder="john.doe" aria-label="john.doe"
                                       aria-describedby="basic-default-email2">
                                <span class="input-group-text" id="basic-default-email2">primjer@primjer.com</span>
                            </div>
                            @error('email') <spam class="text-danger">{{ $message }}</spam>  @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="status">Status</label>
                        <div class="col-sm-3">
                            <select name="isMember" id="isMember" class="form-control">
                                <option value="0">Nije član</option>
                                <option value="1">Član</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="isAdmin" id="isAdmin" class="form-control">
                                <option value="0">Korisnik</option>
                                <option value="1">Administrator</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="status" id="status" class="form-control">
                                <option value="0">Neaktivan</option>
                                <option value="1">Aktivan</option>
                                <option value="2">Na čekanju</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="phone">Kontakt Br.</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('phone') }}" name="phone" id="phone"
                                   class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941"
                                   aria-describedby="phone">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="password">Lozinka</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password') <spam class="text-danger">{{ $message }}</spam>  @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="password_confirmation">Potvrdi lozinku</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                   id="password_confirmation">
                            @error('password_confirmation') <spam class="text-danger">{{ $message }}</spam>  @enderror
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Uredi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('partials.errors')
@endsection
