@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")

<!-- resources/views/roles/create.blade.php -->





    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Modification Prestation</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.planifications.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Modification</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary" href="{{ route('Admin.planifications.index') }}">
									Liste Planification
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Modification</h4>
						<p class="mb-30">Modifier Prestation </p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.planifications.update', $plan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

							<section>
                            <input hidden class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">
                            <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="marque">Nom:</label>
            <input type="text" name="name" value="{{ old('name', $plan->name) }}" class="form-control" required>
        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="numero">type de prestation:</label>
            <input type="text" name="type" value="{{ old('type', $plan->type) }}" class="form-control" required>
        </div>
									</div>
								</div>


                                <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="marque">Date  debut de Prestation:</label>
            <input type="date" name="pest_date" value="{{ old('pest_date', \Carbon\Carbon::parse($plan->pest_date)->format('Y-m-d')) }}" class="form-control" required>
        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="numero">Date fin de prestation:</label>
            <input type="date" name="pest_fin_date" value="{{ old('pest_fin_date', \Carbon\Carbon::parse($plan->pest_fin_date)->format('Y-m-d')) }}" class="form-control" required>
        </div>
									</div>
								</div>

                                <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="marque">Heure debut de Prestation:</label>
            <input type="time"
       name="prest_debut_time"
       value="{{ old('prest_debut_time', \Carbon\Carbon::parse($plan->prest_debut_time)->format('H:i')) }}"
       class="form-control"
       required>
        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="numero">Heure fin de prestation:</label>
            <input type="time"
       name="prest_fin_time"
       value="{{ old('prest_fin_time', \Carbon\Carbon::parse($plan->prest_fin_time)->format('H:i')) }}"
       class="form-control"
       required>
        </div>
									</div>
								</div>









                                <div class="row"  >
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Client:</label>
            <select class="selectpicker form-control" name="client_id"  >
            @foreach(\App\Models\Client::all() as $client)
                    <option value="{{ $client->id }}"
                        @if(isset($plan) && $plan->client_id == $client->id) selected @endif>
                        {{ $client->rai_soci ?? $client->id }}
                    </option>
                @endforeach

									</select>
        </div>
									</div>


                                </div>

							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.planifications.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-primary" >Mettre a jour</button>

                            </div>

						</form>

					</div>
				</div>




			</div>










@endsection

