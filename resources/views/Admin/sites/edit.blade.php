@extends("layouts.master")
@section('title','GEST-APP | Modification  Sites')
@section("contenu")

<!-- resources/views/roles/edit.blade.php -->


    



    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Modifier le Site : {{ $site->nom }}</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.sites.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Modification</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="{{ route('Admin.sites.index') }}" >
									Liste des sites
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Modification</h4>
						<p class="mb-30">Modifier des sites</p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.sites.update', $site->id) }}" method="POST">
        @csrf
        @method('PUT')

							<section>
								<div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" value="{{ $site->nom }}" class="form-control" required>
        </div>
									</div>
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" value="{{ $site->description }}" class="form-control" required>
        </div>
									</div>
								</div>

							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.sites.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-info" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>







@endsection
