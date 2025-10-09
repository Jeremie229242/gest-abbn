
@extends("layouts.master")
@section('title','GEST-APP | Acceuil')
@section("contenu")


<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="{{asset('v2/vendors/images/banner-img.png')}}" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Bienvenue <div class="weight-600 font-30 text-blue">{{ Auth::user()->name }}!</div>
						</h4>
						<p class="font-18 max-width-600">Gest-App est une applicationconcut avec le framework Laravel qui permet de gérer le parc informatique et les abonnements (subscriptions) d’une entreprise ou d’un utilisateur</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$emtotalor}}</div>
								<div class="weight-600 font-14">Ordinateurs</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart2"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$emtotalim}}</div>
								<div class="weight-600 font-14">Imprimantes</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart4"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$ematotalor}}</div>
								<div class="weight-600 font-14">Scanners</div>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart3"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$ematotalor}}</div>
								<div class="weight-600 font-14">Materiels en Panne</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <div class="card-box mb-30">
    <h5 class="pd-20 h5 mb-0">Rapport par Site</h5>
    <div class="list-group">
        @foreach ($sites as $site)
            <a href="{{ route('Admin.sites.rapport', $site->id) }}" class="list-group-item d-flex align-items-center justify-content-between">
                {{ $site->nom }}
                <span class="badge badge-primary badge-pill">{{ $site->total_ordinateurs }}</span>
                <span class="badge badge-success badge-pill">{{ $site->total_imprimantes }}</span>

                <span class="badge badge-info badge-pill">{{ $site->total_scanners }}</span>
            </a>
        @endforeach
    </div>
</div>








            @endsection