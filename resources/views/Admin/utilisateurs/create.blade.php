@extends("layouts.master")
@section('title','AGRO-PLATEAU | Listes Utilisateurs')
@section("contenu")

<!-- resources/views/users/create.blade.php -->
<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Créer un nouveau Utilisateur</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
                                    <li class="breadcrumb-item"><a href="index.html">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Création</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" >
									Liste des utilisateurs
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Création</h4>
						<p class="mb-30">Créer des utilisateur</p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.utilisateurs.store') }}" method="POST">
                    @csrf

							<section>
								<div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
									</div>
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" name="code" id="code" class="form-control" required>
        </div>
									</div>
								</div>

                                <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
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
                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
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
                <option  value="{{ $role->id }}">{{ $role->name }}</option>
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

@section('scripts')

    <script>

    // Code JavaScript pour activer la sélection multiple
        $(document).ready(function () {
            $('#roles').select2();
             $('.select2').select2()

     });
        // Code JavaScript pour gérer la sélection des rôles et des permissions
        document.getElementById('btn-submit').addEventListener('click', function (event) {
            event.preventDefault();

            // Récupérer les rôles et les permissions sélectionnées
            var rolesSelect = document.getElementById('roles');
            var selectedRoles = Array.from(rolesSelect.selectedOptions).map(option => option.value);

            var permissionsSelect = document.getElementById('permissions');
            var selectedPermissions = Array.from(permissionsSelect.selectedOptions).map(option => option.value);

            // Ajouter le code pour envoyer les données au serveur (via une requête AJAX ou autre) pour enregistrer l'utilisateur avec les rôles et les permissions sélectionnées.
            // Vous devrez probablement envoyer les données en tant que JSON dans la requête.

            // Exemple d'utilisation de fetch() pour envoyer les données en tant que JSON (vous pouvez utiliser axios ou jQuery.ajax également)
            fetch('Admin/utilisateurs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: document.getElementById('name').value,
                    code: document.getElementById('code').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    roles: selectedRoles,
                    permissions: selectedPermissions
                })
            })
            .then(response => response.json())
            .then(data => {
                // Traiter la réponse du serveur ici (par exemple, afficher un message de succès)
            })
            .catch(error => {
                // Traiter les erreurs ici (par exemple, afficher un message d'erreur)
            });
        });
    </script>




@endsection
