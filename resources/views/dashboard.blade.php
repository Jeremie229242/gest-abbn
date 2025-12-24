
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
						<p class="font-18 max-width-600">Desk-App est une application concut  qui permet de gérer les abonnements (subscriptions) et vos prestations au pres de vos clients</p>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<!-- <div class="progress-data">
								<div id="chart"></div>
							</div> -->
							<div class="widget-data">
								<div class="h4 mb-0">{{$client}}</div>
								<div class="weight-600 font-14">Clients</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<!-- <div class="progress-data">
								<div id="chart2"></div>
							</div> -->
							<div class="widget-data">
								<div class="h4 mb-0">0</div>
								<div class="weight-600 font-14"><a href="{{ route('Admin.prestations.clients') }}">Nbres de Prestation Par Clients</a></div>
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
								<div class="h4 mb-0">{{$subsactif}}</div>
								<div class="weight-600 font-14"><a href="{{ route('Admin.subscriptions.moi.actifs') }}">Abbonnements Actifs</a> </div>
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
								<div class="h4 mb-0">{{$subsexp}}</div>
								<div class="weight-600 font-14"><a href="{{ route('Admin.subscriptions.moi.expires') }}">Abonnements Expiré</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>


            <div class="row">
            <div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart4"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$prest}}</div>
								<div class="weight-600 font-14">Prestations Globales</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$prestatt}}</div>
								<div class="weight-600 font-14"><a href="{{ route('Admin.prestations.moi.plans') }}">Prestations en attente</a></div>
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
								<div class="h4 mb-0">{{$prestenco}}</div>
								<div class="weight-600 font-14"><a href="{{ route('Admin.prestations.moi.encours') }}">Prestation en cours</a></div>
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
								<div class="h4 mb-0">{{$prestclo}}</div>
								<div class="weight-600 font-14"><a href="{{ route('Admin.prestations.moi.clotures') }}">Prestations Prestation cloturer</a></div>
							</div>
						</div>
					</div>
				</div>

			</div>


            @endsection