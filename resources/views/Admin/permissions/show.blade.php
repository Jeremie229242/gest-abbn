@extends("layouts.master")
@section('title','GEST-PARC | Details Permissions')
@section("contenu")

<!-- resources/views/permissions/show.blade.php -->
<br><br><br>

    <h1>Détails de la permission : {{ $permission->name }}</h1>

    <p><strong>Nom:</strong> {{ $permission->name }}</p>
    <p><strong>Slug:</strong> {{ $permission->slug }}</p>

    <a href="{{ route('Admin.permissions.index') }}" class="btn btn-danger">Retour à la liste des permissions</a>



@endsection
