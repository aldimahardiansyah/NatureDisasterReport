@extends('admin.main')
@section('title')
    <h1>Dashboard</h1>
@endsection
@section('content')
    {{-- get success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif

    <div class="container-fluid">
        <h2>Selamat Datang di Dashboard Admin!</h2>

        <hr>

        <div class="card mt-5">
            <div class="card-title p-4">
                <h4>Approval Laporan Bencana Alam</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Bencana</th>
                                <th>Tanggal</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Dilaporkan Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($disasters as $disaster)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $disaster->nama }}</td>
                                    <td>{{ $disaster->tgl }}</td>
                                    <td>{{ $disaster->lat }}</td>
                                    <td>{{ $disaster->long }}</td>
                                    <td>{{ $disaster->created_at }}</td>
                                    <td>
                                        <a href="disaster/{{ $disaster->id }}/approve" class="btn btn-warning">Approve</a>
                                        <a href="disaster/{{ $disaster->id }}/reject" class="btn btn-danger">Reject</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
