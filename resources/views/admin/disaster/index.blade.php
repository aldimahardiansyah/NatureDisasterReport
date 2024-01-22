@extends('admin.main')
@section('title')
    <h1>Manajemen Bencana Alam</h1>
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
        <div class="card">
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
                                    <td>
                                        <a href="{{ route('disaster.edit', $disaster->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('disaster.destroy', $disaster->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
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
