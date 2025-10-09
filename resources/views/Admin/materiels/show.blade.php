@extends("layouts.master")
@section('title','GEST-APP | Details Materiel')
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
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.materiels.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Detail</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <div class="container px-0">
<div class="card card-primary card-outline">
<div class="card-body box-profile">

<h3 class="profile-username text-center">{{ $materiel->code }}</h3>
<p class="text-muted text-center">...............</p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Code</b> <a class="float-right">{{ $materiel->code }}</a>
</li>
<li class="list-group-item">
<b>Materiel</b> <a class="float-right">{{ $materiel->ordi }}</a>
</li>
<li class="list-group-item">
<b>Type</b> <a class="float-right">{{ $materiel->type }}</a>
</li>
<li class="list-group-item">
<b>Addresse</b> <a class="float-right">{{ $materiel->numero }}</a>
</li>
<li class="list-group-item">
<b>capacite</b> <a class="float-right">{{ $materiel->capacite }}</a>
</li>
<li class="list-group-item">
<b>RAM</b> <a class="float-right">{{ $materiel->ram }}</a>
</li>
<li class="list-group-item">
<b>Marque:</b> <a class="float-right">{{ $materiel->marque }}</a>
</li>
<li class="list-group-item">
<b>Etat:</b> <a class="float-right">{{ $materiel->etat }}</a>
</li>


<li class="list-group-item">
<b>Permissions</b>

            <a class="float-right">{{ $materiel->personnel->nom }}</a>

</li>


<li class="list-group-item">
<b>Roles</b>

            <a class="float-right">{{ $materiel->site->nom }}</a>

</li>


<li class="list-group-item">
<b>Ajoutée le</b> <a class="float-right">{{ $materiel->created_at }}</a>
</li>
<li class="list-group-item">
<b>Par</b> <a class="float-right">{{ $materiel->user->name }}</a>
</li>
</ul>
<a href="{{ route('Admin.materiels.index') }}" class="btn btn-dark btn-block"><b>Retour</b></a>
</div>

</div>
                </div>
                <br><br><br>
@endsection