@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")



<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Souscriptions actifs</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Souscriptions actifs</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">

						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($actifs) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste du Souscriptions actifs</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Client</th>
                                    <th>Date Abbn</th>
                                    <th>Date exp</th>
                                    <th>Jours restants</th>

								</tr>
							</thead>
							<tbody>
                            @foreach ($actifs as $p)
								<tr>
									<td class="table-plus">{{ $p->client->rai_soci }}</td>
                                    <td class="table-plus">{{ $p->subscription_date->format('d/m/Y') }}</td>
                                    <td class="table-plus">{{ $p->expiration_date->format('d/m/Y') }}</td>
                                    <td > <span class="days-left"
                    data-expiration="{{ $p->expiration_date }}"
                    data-remind="{{ $p->remind_before_days }}"></span>
                    <!-- Le JS calculera et colorera -->
                </td>


								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                @else
        <p>Aucun Nom trouvé.</p>
    @endif


    <script>
document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    const elements = document.querySelectorAll(".days-left");

    elements.forEach(el => {
        const expDate = new Date(el.dataset.expiration);
        const remindDays = parseInt(el.dataset.remind);

        // Calcul du nombre de jours restants
        const diffTime = expDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        // Couleur par défaut
        let color = "green";
        let bg = "transparent";
        let label = diffDays + " jour" + (diffDays > 1 ? "s" : "");

        // ⚙️ Gestion dynamique selon remind_before_days
        if (diffDays <= 0) {
            color = "white";
            bg = "red";
            label = "Expiré";
        } else if (diffDays <= remindDays) {
            color = "white";
            bg = "orange";
            label = `⚠️ ${diffDays} jour${diffDays > 1 ? "s" : ""} rest.`; // alerte
        } else if (diffDays <= remindDays + 5) {
            color = "black";
            bg = "yellow";
        }

        // Applique le style
        el.textContent = label;
        el.style.color = color;
        el.style.backgroundColor = bg;
        el.style.padding = "8px 8px";
        el.style.borderRadius = "6px";
        el.style.fontWeight = "bold";
        el.style.textAlign = "center";
    });
});
</script>

@endsection