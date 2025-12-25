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
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.prestations.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Detail</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <div class="container px-0">
<div class="card card-primary card-outline">
<div class="card-body box-profile">

<h3 class="profile-username text-center">{{ $cloture->name }}</h3>
<p class="text-muted text-center">...............</p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Client</b> <a class="float-right">{{ $cloture->client->rai_soci }}</a>
</li>
<li class="list-group-item">
<b>Date de debut planification</b> <a class="float-right">{{ $cloture->pest_date }}</a>
</li>
<li class="list-group-item">
<b>Date fin de prestation</b> <a class="float-right">{{ $cloture->pest_fin_date }}</a>
</li>

<li class="list-group-item">
<b>Date fin de prestation</b> <a class="float-right">{{ $cloture->pestclot_date }}</a>
</li>

<li class="list-group-item">
<b>Durée </b>

<a class="float-right"><span class="duration-cell" data-start="{{ $cloture->pest_date }}"
data-end="{{ $cloture->pestclot_date }}"></span></a>

</li>
<li class="list-group-item">
<b>Status </b>

<a class="float-right"><span class="badge bg-danger">{{ $cloture->status }}</span></a>

</li>
<li class="list-group-item">
<b>Type de prestaion</b> <a class="float-right">{{ $cloture->type }}</a>
</li>





<div class="row">
						<div class="col-md-12 mb-30">
							<div class="card-box pricing-card mt-30 mb-30">

								<div class="price-title">
                               Detail des Observations
								</div>
                                @foreach($cloture->observations as $obs)
								<div class="text">
                                {{ $obs->observation }} <br>
            du {{ \Carbon\Carbon::parse($obs->obs_debut_date)->translatedFormat('d M Y') }} à {{ $obs->obs_debut_time }}
            au {{ \Carbon\Carbon::parse($obs->obs_fin_date)->translatedFormat('d M Y') }} à {{ $obs->obs_fin_time }}
								</div>

    @endforeach
							</div>
						</div>

					</div>



<li class="list-group-item">
<b>Ajoutée le</b> <a class="float-right">{{ $cloture->created_at }}</a>
</li>
<li class="list-group-item">
<b>Par</b> <a class="float-right">{{ $cloture->user->name }}</a>
</li>
</ul>
<a href="{{ route('Admin.clotures.index') }}" class="btn btn-dark btn-block"><b>Retour</b></a>
</div>

</div>
                </div>
                <br><br><br>

                <script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.duration-cell').forEach(cell => {
        const start = new Date(cell.dataset.start);
        const end = new Date(cell.dataset.end);

        if (!isNaN(start) && !isNaN(end)) {
            const diffTime = end - start;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            cell.textContent = diffDays + " jour" + (diffDays > 1 ? "s" : "");
        } else {
            cell.textContent = "—";
        }
    });
});
</script>
@endsection