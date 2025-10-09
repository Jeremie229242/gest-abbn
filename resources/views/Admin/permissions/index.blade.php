@extends("layouts.master")
@section('title','GEST-PARC | Listes Permissions')
@section("contenu")

<!-- resources/views/permissions/index.blade.php -->

<br><br><br><br>
@if(Session::has('message'))
                               

                                <div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fas fa-check"></i>{{Session::get('message')}}</h5>

</div>
                                @endif
    <h1>Liste des permissions</h1>

    <a href="{{ route('Admin.permissions.create') }}" class="btn btn-primary mb-2">Nouvelle permission</a>

    @if(count($permissions) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->slug }}</td>
                        <td>
                            <a href="{{ route('Admin.permissions.show', $permission->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('Admin.permissions.edit', $permission->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('Admin.permissions.destroy', $permission->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune permission trouvée.</p>
    @endif


@endsection
