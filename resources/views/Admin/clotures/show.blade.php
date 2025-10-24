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
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.maintenances.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Detail</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <div class="container px-0">
<div class="card card-primary card-outline">
<div class="card-body box-profile">

<h3 class="profile-username text-center">{{ $maintenance->code }}</h3>
<p class="text-muted text-center">...............</p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Code maintenance</b> <a class="float-right">{{ $maintenance->code }}</a>
</li>
<li class="list-group-item">
<b>Date de la panne</b> <a class="float-right">{{ $maintenance->date_panne }}</a>
</li>
<li class="list-group-item">
<b>Motif</b> <a class="float-right">{{ $maintenance->motif }}</a>
</li>
<li class="list-group-item">
<b>Status du materiel</b> <a class="float-right">{{ $maintenance->status }}</a>
</li>
<li class="list-group-item">
<b>code materiel</b> <a class="float-right">{{ $maintenance->materiel->code }}</a>
</li>





<div class="row">
						<div class="col-md-12 mb-30">
							<div class="card-box pricing-card mt-30 mb-30">

								<div class="price-title">
                               Detail de la reparation
								</div>
                                @foreach ($maintenance->reparation as $index)
								<div class="text">
                                {{ $index }}
								</div>
                                @endforeach
							</div>
						</div>

					</div>



<li class="list-group-item">
<b>Ajoutée le</b> <a class="float-right">{{ $maintenance->created_at }}</a>
</li>
<li class="list-group-item">
<b>Par</b> <a class="float-right">{{ $maintenance->user->name }}</a>
</li>
</ul>
<a href="{{ route('Admin.maintenances.index') }}" class="btn btn-dark btn-block"><b>Retour</b></a>
</div>

</div>
                </div>
                <br><br><br>
@endsection