@extends("layouts.master")
@section('title','GEST-APP | Ajout de Roles')
@section("contenu")

<!-- resources/views/roles/create.blade.php -->





    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Créer un nouveau rôle</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.roles.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Création</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" >
									Liste des roles
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Création</h4>
						<p class="mb-30">Créer des roles qui sont affecter a chaque utilisateur</p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.roles.store') }}" method="POST">
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
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" required>
        </div>
									</div>
								</div>

							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.roles.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-primary" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>










<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        // Écouteur d'événement pour mettre à jour le champ slug à partir du champ name
        $(document).ready(function () {
            $('#name').on('input', function () {
                const name = $(this).val();
                const slug = slugify(name);
                $('#slug').val(slug);
            });
        });

        // Fonction pour générer un slug à partir d'une chaîne
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Remplace les espaces par des tirets
                .replace(/[^\w\-]+/g, '')       // Supprime tous les caractères non alphanumériques, sauf les tirets
                .replace(/\-\-+/g, '-')         // Remplace les doubles tirets par un seul tiret
                .replace(/^-+/, '')             // Supprime les tirets en début de chaîne
                .replace(/-+$/, '');            // Supprime les tirets en fin de chaîne
        }
    </script>

@endsection

