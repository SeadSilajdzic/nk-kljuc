@extends('layouts.dashboard')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.index') }}">Početna</a> /
        </span>
        <a href="{{ route('dashboard.post.index') }}">Objave</a>
    </h4>

    @include('partials.alerts')

    <div class="card">
        <h5 class="card-header">Lista objava</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Naslov</th>
                        <th>Autor</th>
                        <th>Kategorija</th>
                        <th>Status</th>
                        <th>Tagovi</th>
                        <th>Akcije</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                {{ $post->title }}
                            </td>
                            <td>
                                {{ $post->user->name }}
                            </td>
                            <td>
                                {{ $post->category->name }}
                            </td>
                            <td>
                                <span
                                    class="badge @if($post->status == 0) bg-label-danger @elseif($post->status == 1) bg-label-primary @endif me-1">
                                    @if($post->status == 0)
                                        Neaktivan
                                    @else
                                        Aktivan
                                    @endif
                                </span>
                            </td>
                            <td>
                                {{ $post->tags_count }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('dashboard.post.edit', $post) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Uredi</a>
                                        <form action="{{ route('dashboard.post.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button name="btn_archieve" class="dropdown-item"><i
                                                    class="bx bx-trash me-1"></i>Arhiviraj</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="ss-pagination">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
@endsection
