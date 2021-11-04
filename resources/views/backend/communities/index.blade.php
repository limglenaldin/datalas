@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Komunitas</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>List Komunitas</h4>
                        <div class="card-header-action">
                            @hasrole('webmaster')
                            <a href="{{ route('backend.communities.createView') }}" class="btn btn-primary"><i
                                    class="fas fa-plus"></i></a>
                            @endhasrole
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="userslist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Komunitas</th>
                                        <th>Slug</th>
                                        <th>Provinsi</th>
                                        <th>Kota</th>
                                        <th>Alamat</th>
                                        <th>Kontak</th>
                                        <th>Nomor Kontak</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($communities as $communitie)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $communitie->name }}</td>
                                            <td>{{ $communitie->slug }}</td>
                                            <td>{{ $communitie->province_id }}</td>
                                            <td>{{ $communitie->origin_id }}</td>
                                            <td>{{ $communitie->address }}</td>
                                            <td>{{ $communitie->contact_name }}</td>
                                            <td>{{ $communitie->contact_phone }}</td>
                                            <td>{{ $communitie->is_active === 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                            <td>
                                                <a href="{{ route('backend.communities.editView', ['id' => $communitie->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('backend.communities.delete', ['id' => $communitie->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Community?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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
        </div>
    </section>
@endsection

@push('js-additional')
    <script>
        $("#userslist").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [3, 5]
            }]
        });

    </script>
@endpush
