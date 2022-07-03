@extends('layouts.dashboard')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('dashboard.index') }}">Početna</a> /
        </span>
        <a href="{{ route('dashboard.user.members') }}">Članovi</a>
    </h4>

    @include('partials.alerts')

    <div class="card">
        <h5 class="card-header">Lista članova ({{ $membersCount }})</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Br.</th>
                        <th>Ime</th>
                        <th>Email</th>
                        <th>Uloga</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>
                                <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>
                                    {{ $member->id }}
                                </strong>
                            </td>
                            <td>
                                {{ $member->name }}
                            </td>
                            <td>
                                {{ $member->email }}
                            </td>
                            <td>
                                {{ $member->isAdmin ? 'Admin' : 'Korisnik' }}
                            </td>
                            <td>
                                <span
                                    class="badge @if($member->status == 0) bg-label-danger @elseif($member->status == 1) bg-label-primary @elseif($member->status == 2) bg-label-warning @endif me-1">
                                    @if($member->status == 0)
                                        Neaktivan
                                    @elseif($member->status == 1)
                                        Aktivan
                                    @else
                                        Na čekanju
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="ss-pagination">{{ $members->links() }}</div>
            </div>
        </div>
    </div>
@endsection
