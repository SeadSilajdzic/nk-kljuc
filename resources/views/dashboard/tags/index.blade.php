@extends('layouts.dashboard')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.index') }}">Početna</a> /
        </span>
        <a href="{{ route('dashboard.tag.index') }}">Tagovi</a>
    </h4>

    @include('partials.alerts')

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">Lista tagova</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Br.</th>
                                <th>Tag</th>
                                <th>Broj objava</th>
                                <th>Akcije</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>
                                            {{ $tag->id }}
                                        </strong>
                                    </td>
                                    <td>
                                        {{ $tag->name }}
                                    </td>
                                    <td>
                                        {{ $tag->posts_count }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                   href="{{ route('dashboard.tag.edit', $tag) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Uredi</a>
                                                <form action="{{ route('dashboard.tag.destroy', $tag) }}" method="post"
                                                      onclick="return confirm('Da li si siguran da želiš trajno obrisati tag?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button name="btn_archieve" class="dropdown-item"><i
                                                            class="bx bx-trash me-1"></i>Obriši
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="ss-pagination">{{ $tags->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Dodaj novi tag</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.tag.store') }}" method="post">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">Ime</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror" id="name"
                                           placeholder="Gosti">
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
        </div>
    </div>
@endsection
