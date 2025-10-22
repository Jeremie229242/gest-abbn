@extends("layouts.master")
@section('title','GEST-APP | Ajout Abonnement')
@section("contenu")

<!-- resources/views/roles/create.blade.php -->





    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Créer un nouvel Abonnement</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.subscriptions.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Création</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary " href="{{ route('Admin.subscriptions.index') }}" >
									Liste Abonnement
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Création</h4>
						<p class="mb-30">Créer Abonnement </p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.subscriptions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

							<section>
                            <input hidden class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">

								<div class="row">

									<div class="col-md-6">
                                    <div class="form-group">
            <label for="name">Nom Abonnement:</label>
            <input type="text" name="name" id="name" class="form-control" required>

        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="name">Entite:</label>
            <input type="text" name="entity" id="entity" class="form-control" required>

        </div>
									</div>
                                </div>


                                <div class="row" >
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Societé:</label>
            <select class="selectpicker form-control" name="site_id"  >
            @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->nom }}</option>
                                    @endforeach

									</select>
        </div>
									</div>


                                </div>



                                <div class="row">

									<div class="col-md-6">
                                    <div class="form-group">
            <label for="subscription_date">Date debut Abonnement:</label>
            <input type="date" name="subscription_date" id="subscription_date" class="form-control" required>

        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="expiration_date">Date fin Abonnement:</label>
            <input type="date" name="expiration_date" id="expiration_date" class="form-control" required>

        </div>
									</div>
                                </div>





                                <div class="row">

<div class="col-md-6">
<div class="form-group">
<label for="remind_before_days">Nbre de jour de rappel avant La date d'expiration:</label>
<input type="remind_before_days" name="remind_before_days" id="remind_before_days" class="form-control" required>


</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="expiration_date">Typre abonnement:</label>
<select class="selectpicker form-control"  name="type" >
										<option value="licence">Licence</option>
										<option value="internet">Internet</option>

									</select>
</div>
</div>
</div>

                                    <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
		<label>Document</label>
		<div class="custom-file">
			<input type="file" name="file" class="custom-file-input">
			<label class="custom-file-label">Choisir un fichier</label>
		</div>
	</div>
									</div>

								</div>

                                <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Email de rappel:</label>

                                    <select name="emails[]" id="emails" class="selectpicker form-control" multiple required>
        @foreach(\App\Models\Email::all() as $email)
            <option value="{{ $email->email }}">{{ $email->email }}</option>
        @endforeach
    </select>
    <small class="text-muted">Maintenez CTRL (ou CMD sur Mac) pour sélectionner plusieurs emails</small>


        </div>
									</div>


                                </div>

                                <div class="form-group mt-3">
    <label for="new_emails">Nouveaux emails (séparés par des virgules) :</label>
    <input type="text" name="new_emails" id="new_emails" class="form-control"
           placeholder="ex: test1@mail.com, test2@mail.com">
    <small class="text-muted">Tu peux entrer plusieurs emails séparés par une virgule</small>
</div>





							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.subscriptions.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-primary" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>










@endsection

