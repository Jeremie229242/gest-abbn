@extends("layouts.master")
@section('title','GEST-APP | Liste des Utilisateurs')
@section("contenu")

<!-- resources/views/roles/index.blade.php -->
@if(Session::has('message'))


                                <div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fas fa-check"></i>{{Session::get('message')}}</h5>

</div>
                                @endif
                                <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Les des Utilisateurs</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary" href="{{ route('Admin.utilisateurs.create') }}">
									Ajouter
								</a>

							</div>
						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($users) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste des utilisateurs</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Nom</th>
                                    <th>Email</th>
                    <th>Rôles</th>
                    <th>Permissions</th>
									<th>Ajouter le</th>

                                    <th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                            @foreach($users as $user)
								<tr>
									<td class="table-plus">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                        <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                        <td>{{ implode(', ', $user->permissions->pluck('name')->toArray()) }}</td>
									<td>{{ $user->created_at }}</td>

                                    <td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('Admin.utilisateurs.show', $user->id) }}"><i class="dw dw-eye"></i> Voir</a>
												<a class="dropdown-item" href="{{ route('Admin.utilisateurs.edit', $user->id) }}"><i class="dw dw-edit2"></i> Modifier</a>
												<a class="dropdown-item" ><i class="dw dw-delete-3"></i>
                                                <form action="{{ route('Admin.utilisateurs.destroy', $user->id) }}"
                                 method="POST" onsubmit="return confirm('{{ trans('Etes Vous Sure Pour la Suppression') }}' );"
                                  style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('Supprimer') }}">
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
        <p>Aucun rôle trouvé.</p>
    @endif
				<!-- Export Datatable End -->

			</div>


@endsection
