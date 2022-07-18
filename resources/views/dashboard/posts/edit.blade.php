@extends('layouts.dashboard')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.index') }}">Početna</a> /
        </span>
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.post.index') }}">Objave</a> /
        </span>
        <a href="{{ route('dashboard.post.edit', $post) }}">Uredi Objavu</a>
    </h4>

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Uredi informacije za objavu "{{ $post->title }}"</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.post.update', $post) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="title">Naslov</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('title', $post->title) }}"
                                   class="form-control @error('title') is-invalid @enderror" name="title"
                                   id="title" placeholder="Nova pobjeda NK Ključ-a...">
                            @error('title')
                            <spam class="text-danger">{{ $message }}</spam> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subtitle">Podnaslov</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('subtitle', $post->subtitle) }}"
                                   class="form-control @error('subtitle') is-invalid @enderror" name="subtitle"
                                   id="subtitle" placeholder="NK Ključ je opet iznenadio svoj protivnike...">
                            @error('subtitle')
                            <spam class="text-danger">{{ $message }}</spam> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="short_description">Kratki opis</label>
                        <div class="col-sm-10">
                            <textarea name="short_description" id="short_description" cols="30" rows="10"
                                      placeholder="NK Ključ je opet iznenadio svoj protivnike..."
                                      class="form-control @error('short_description') is-invalid @enderror"
                            >{{ old('short_description', $post->short_description) }}</textarea>
                            @error('short_description')
                            <spam class="text-danger">{{ $message }}</spam> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="description">Sadržaj</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" cols="30" rows="10"
                                      placeholder="NK Ključ je opet iznenadio svoj protivnike..."
                                      class="form-control @error('description') is-invalid @enderror"
                            >{{ old('description', $post->description) }}</textarea>
                            @error('description')
                            <spam class="text-danger">{{ $message }}</spam> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="description">Odaberite tagove</label>
                        <div class="col-sm-10 d-flex flex-wrap">
                            @foreach($tags as $tag)
                                <div class="form-group m-2">
                                    <input type="checkbox" id="{{ $tag->id }}" value="{{ $tag->id }}" name="tags[]"
                                        @foreach($post->tags as $t)
                                            @if($tag->id == $t->id)
                                                checked
                                            @endif
                                        @endforeach
                                    >
                                    <label for="{{ $tag->id }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="status">Status</label>
                        <div class="col-sm-4">
                            <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                <option value="0" @if($post->status == 0) selected @endif>Neaktivno</option>
                                <option value="1" @if($post->status == 1) selected @endif>Aktivno</option>
                            </select>
                            @error('status')
                            <spam class="text-danger">{{ $message }}</spam> @enderror
                        </div>

                        <label class="col-sm-2 col-form-label" for="user_id">Autor</label>
                        <div class="col-sm-4">
                            <select name="user_id" id="user_id"
                                    class="form-control @error('user_id') is-invalid @enderror">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($post->user_id === $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <spam class="text-danger">{{ $message }}</spam> @enderror
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
