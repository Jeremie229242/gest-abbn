@extends("layouts.master")
@section('title','GEST-APP | Details Maintenances')
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
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.planifications.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Detail</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <div class="container px-0">
<div class="card card-primary card-outline">
<div class="card-body box-profile">

<h3 class="profile-username text-center">{{ $planification->name }}</h3>
<p class="text-muted text-center">...............</p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Client</b> <a class="float-right">{{ $planification->client->rai_soci }}</a>
</li>
<li class="list-group-item">
<b>Date de debut prestation</b> <a class="float-right">{{ $planification->pest_date }}</a>
</li>
<li class="list-group-item">
<b>Date fin de prestation</b> <a class="float-right">{{ $planification->pest_fin_date }}</a>
</li>
<li class="list-group-item">
<b>Status </b> <a class="float-right">{{ $planification->status }}</a>
</li>
<li class="list-group-item">
<b>Type de prestaion</b> <a class="float-right">{{ $planification->type }}</a>
</li>





<div class="row">
						<div class="col-md-12 mb-30">
							<div class="card-box pricing-card mt-30 mb-30">

								<div class="price-title">
                               Detail
								</div>

								<div class="text">
                                0
								</div>

							</div>
						</div>

					</div>



<li class="list-group-item">
<b>Ajoutée le</b> <a class="float-right">{{ $planification->created_at }}</a>
</li>
<li class="list-group-item">
<b>Par</b> <a class="float-right">{{ $planification->user->name }}</a>
</li>
</ul>
<a href="{{ route('Admin.planifications.index') }}" class="btn btn-dark btn-block"><b>Retour</b></a>
</div>

</div>
                </div>
                <br><br><br>
@endsection