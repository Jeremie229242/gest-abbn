
@extends("layouts.master")
@section('title','GEST-APP | Modification Utilisateurs')
@section("contenu")

<!-- resources/views/users/create.blade.php -->

<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Modification Utilisateur : {{ $user->name }}</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.utilisateurs.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Modification</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary " href="{{ route('Admin.utilisateurs.index') }}" >
									Liste des utilisateurs
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Modification</h4>
						<p class="mb-30">Modification utilisateur</p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.utilisateurs.update', [$user->id]) }}" method="POST">
         @csrf
        @method('PUT')


							<section>
								<div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" required>
        </div>
									</div>
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" name="code" id="code" value="{{ $user->code }}" class="form-control" required>
        </div>
									</div>
								</div>

                                <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
        </div>
									</div>
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="password">Mot de Passe:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
									</div>
								</div>

                                <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
                                    <label for="permissions">Permissions:</label>
        <div class="select2-purple">
        <select  class="custom-select2 select2" multiple="multiple"
         style="width: 100%;"
          name="permissions[]" id="permissions">
            <!-- Boucle pour afficher la liste des permissions -->
            @foreach($permissions as $permission)
    <option value="{{ $permission->id }}"
    {{ $user->permissions->contains('id', $permission->id) ? 'selected' : '' }}
    >{{ $permission->name }}</option>
@endforeach
        </select>
    </div>
  </div>
									</div>
									<div class="col-md-6">
                                    <div class="form-group ">
        <label for="roles">Rôles:</label>
        <div >
        <select  class="custom-select2 select2 form-control" multiple="multiple"
         style="width: 100%;"
           name="roles[]" id="roles">
            <!-- Boucle pour afficher la liste des rôles -->

            @foreach($roles as $role)
                <option  value="{{ $role->id }}"

                {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}
                >{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    </div>
									</div>
								</div>

							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.utilisateurs.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-primary" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>

@endsection




