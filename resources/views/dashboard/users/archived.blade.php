@extends('layouts.dashboard')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.index') }}">Početna</a> /
        </span>
        <a href="{{ route('dashboard.user.archived') }}">Arhivirani korisnici</a>
    </h4>

    @include('partials.alerts')

    <div class="card">
        <h5 class="card-header">Lista korisnika</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Br.</th>
                        <th>Ime</th>
                        <th>Email</th>
                        <th>Član</th>
                        <th>Uloga</th>
                        <th>Status</th>
                        <th>Akcije</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>
                                    {{ $user->id }}
                                </strong>
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->isMember ? 'Član' : 'Nije član' }}
                            </td>
                            <td>
                                {{ $user->isAdmin ? 'Admin' : 'Korisnik' }}
                            </td>
                            <td>
                                <span
                                    class="badge @if($user->status == 0) bg-label-danger @elseif($user->status == 1) bg-label-primary @elseif($user->status == 2) bg-label-warning @endif me-1">
                                    @if($user->status == 0)
                                        Neaktivan
                                    @elseif($user->status == 1)
                                        Aktivan
                                    @else
                                        Na čekanju
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <form action="{{ route('dashboard.user.restore', $user) }}" method="post">
                                            @csrf
                                            <button name="btn_archieve" class="dropdown-item"><i
                                                    class="bx bx-recycle me-1"></i>Vrati
                                            </button>
                                        </form>
                                        <form action="{{ route('dashboard.user.forceDelete', $user) }}"
                                              onclick="return confirm('Da li si siguran da želiš trajno obrisati korisnika?')"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button name="btn_archieve" class="dropdown-item"><i
                                                    class="bx bx-x-circle me-1"></i>Obriši
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="ss-pagination">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
@endsection
