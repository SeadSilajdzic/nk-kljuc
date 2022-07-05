@extends('layouts.dashboard')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.index') }}">Početna</a> /
        </span>
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.tag.index') }}">Tagovi</a> /
        </span>
        <a href="{{ route('dashboard.tag.update', $tag) }}">Uredi tag</a>
    </h4>

    @include('partials.alerts')

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Uredi tag "{{ $tag->name }}"</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.tag.update', $tag) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="name">Ime</label>
                        <div class="col-sm-10">
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   placeholder="Gosti" value="{{ old('tag', $tag->name) }}">
                            @error('name') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Sačuvaj</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
