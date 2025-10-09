@extends("layouts.master")
@section('title','GEST-APP | Details Roles')
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
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.roles.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Detail</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="container px-0">
					<h4 class="mb-30 text-blue h4">Détails du rôle : {{ $role->name }}</h4>
					<div class="row">
						<div class="col-md-12 mb-30">
							<div class="card-box pricing-card mt-30 mb-30">

								<div class="price-title">
                                {{ $role->name }}
								</div>

								<div class="text">
                                {{ $role->name }}<br> {{ $role->slug }}
								</div>
								<div class="cta">
									<a href="{{ route('Admin.roles.index') }}" class="btn btn-danger btn-rounded btn-lg">Retour </a>
								</div>
							</div>
						</div>

					</div>


				</div>




@endsection
