@extends("layouts.master")
@section('title','GEST-APP | Liste des Mails')
@section("contenu")


                                <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Les Mails</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Mails</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary" href="{{ route('Admin.e-mails.create') }}">
									Ajouter
								</a>

							</div>
						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($emails) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste des Mails</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">code</th>
                                    <th class="table-plus datatable-nosort">nom</th>
                                    <th class="table-plus datatable-nosort">E-MAIL</th>


									<th>Ajouter le</th>

                                    <th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                            @foreach($emails as $email)
								<tr>
                                <td class="table-plus">{{ $email->code }}</td>
									<td class="table-plus">{{ $email->name }}</td>
                                    <td class="table-plus">{{ $email->email }}</td>

									<td>{{ $email->created_at }}</td>

                                    <td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('Admin.e-mails.show', $email->id) }}"><i class="dw dw-eye"></i> Voir</a>
												<a class="dropdown-item" href="{{ route('Admin.e-mails.edit', $email->id) }}"><i class="dw dw-edit2"></i> Modifier</a>
												<a class="dropdown-item" ><i class="dw dw-delete-3"></i>
                                                <form action="{{ route('Admin.e-mails.destroy', $email->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                                            </a>
											</div>
										</div>
									</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                @else
        <p>Aucun Mail trouvé.</p>
    @endif
				<!-- Export Datatable End -->

			</div>


@endsection
