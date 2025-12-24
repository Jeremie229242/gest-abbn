@extends("layouts.master")
@section('title','GEST-APP | Details Societe')
@section("contenu")

<!-- resources/views/roles/show.blade.php -->


    <div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Detail</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.clients.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Detail</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="container px-0">
					<h4 class="mb-30 text-blue h4">Détails du client : {{ $client->rai_soci }}</h4>
					<div class="row">
						<div class="col-md-12 mb-30">
							<div class="card-box pricing-card mt-30 mb-30">

								<div class="price-title">
                                {{ $client->rai_soci }}
								</div>
                                <div class="text">
                                <b>Intitule:</b> {{ $client->intitule}}
                                </div>
                                <div class="text">
                                <b>Adresse:</b> {{ $client->adresse }}
                                </div>
                                <div class="text">
                                <b>Telephone:</b> {{ $client->numero }}
                                </div>
                                <div class="text">
                                <b>Intermediaire:</b> {{ $client->inter_prin }}
                                </div>
                                <div class="text">
                                <b>Pays:</b> {{ $client->pays }}
                                </div>
                                <div class="text">
                                <b>Ville:</b> {{ $client->ville }}
                                </div>

								<div class="text">
    @if($client->emails->count() > 0)
        @foreach($client->emails as $email)
            <span class="badge bg-info">{{ $email->email }}</span>
        @endforeach
    @else
        <em>Aucun email enregistré</em>
    @endif
</div>
<div class="text">
                                <b>Créer le :</b> {{ $client->created_at }}
                                </div>
                                <div class="text">
                                <b>Par :</b> {{ $client->user->name }}
                                </div>
								<div class="cta">
									<a href="{{ route('Admin.clients.index') }}" class="btn btn-danger btn-rounded btn-lg">Retour </a>
								</div>
							</div>
						</div>

					</div>


				</div>




@endsection
