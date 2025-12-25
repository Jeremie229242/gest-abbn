@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")

<!-- resources/views/roles/create.blade.php -->





    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Modifier les observations pour le client {{ $prestation->client->rai_soci ?? 'N/A' }}</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.prestations.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Modification</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" >
									Liste Prestations
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Modification</h4>
						<p class="mb-30">Modifier les observations pour Le Client {{ $prestation->client->rai_soci ?? 'N/A' }} </p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.prestations.observations.update', $prestation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
							<section>
                            <input hidden class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">

                            @foreach($prestation->observations as $keys => $obs)
                            <h5>Observation #{{ $keys + 1 }}</h5>
                            <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="marque">Observation:</label>
            <input type="text" name="observations[{{ $obs->id }}][observation]" id="marque" value="{{ old('observations.{$obs->id}.observation', $obs->observation) }}" class="form-control" required>
        </div>
									</div>

								</div>


                                <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="marque">Date  debut de Prestation:</label>
            <input type="date" name="observations[{{ $obs->id }}][obs_debut_date]" id="marque" value="{{ old('observations.{$obs->id}.obs_debut_date', $obs->obs_debut_date) }}" class="form-control" required>
        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="numero">Date fin de prestation:</label>
            <input type="date" name="observations[{{ $obs->id }}][obs_fin_date]" id="marque" value="{{ old('observations.{$obs->id}.obs_fin_date', $obs->obs_fin_date) }}" class="form-control" required>
        </div>
									</div>
								</div>

                                <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="marque">Heure debut de Prestation:</label>
            <input type="time" name="observations[{{ $obs->id }}][obs_debut_time]" id="marque" value="{{ old('observations.{$obs->id}.obs_debut_time', $obs->obs_debut_time) }}" class="form-control" required>
        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="numero">Heure fin de prestation:</label>
            <input type="time" name="observations[{{ $obs->id }}][obs_fin_time]" id="marque" value="{{ old('observations.{$obs->id}.obs_fin_time', $obs->obs_fin_time) }}" class="form-control" required>
        </div>
									</div>
								</div>


                                @endforeach








							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.prestations.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-primary" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>









@endsection

