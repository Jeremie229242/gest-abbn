@extends("layouts.master")

@section("contenu")

<!-- resources/views/users/show.blade.php -->

{{--
    <h1>Détails de l'utilisateur : {{ $user->name }}</h1>

    <p><strong>Nom:</strong> {{ $user->name }}</p>
    <p><strong> Code:</strong> {{ $user->code }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <h2>Rôles:</h2>
    <ul>
        @foreach($user->roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </ul>

    <h2>Permissions:</h2>
    <ul>
        @foreach($user->permissions as $permission)
            <li>{{ $permission->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('Admin.utilisateurs.index') }}" class="btn btn-primary">Retour à la liste des utilisateurs</a> --}}



<br>

<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Detail</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.utilisateurs.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Detail</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="container px-0">
<div class="card card-primary card-outline">
<div class="card-body box-profile">

<h3 class="profile-username text-center">{{ $user->name }}</h3>
<p class="text-muted text-center">{{getRolesName()}}</p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Code Personnel</b> <a class="float-right">{{ $user->code }}</a>
</li>
<li class="list-group-item">
<b>Email:</b> <a class="float-right">{{ $user->email }}</a>
</li>

<li class="list-group-item">
<b>Permissions</b>
 @foreach($user->permissions as $permission)
            <a class="float-right">{{ $permission->name }}</a>
        @endforeach
</li>


<li class="list-group-item">
<b>Roles</b>
 @foreach($user->roles as $role)
            <a class="float-right">{{ $role->name }}</a>
        @endforeach
</li>


<li class="list-group-item">
<b>Ajoutée le</b> <a class="float-right">{{ $user->created_at }}</a>
</li>
</ul>
<a href="{{ route('Admin.utilisateurs.index') }}" class="btn btn-dark btn-block"><b>Retour</b></a>
</div>

</div>
                </div>
                <br><br><br>
@endsection
