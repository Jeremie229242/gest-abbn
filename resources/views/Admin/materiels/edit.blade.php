@extends("layouts.master")
@section('title','GEST-APP | Modification Materiel')
@section("contenu")

<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Modifier le materiel : {{ $materiel->code }}</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="\">Acceuil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.materiels.index') }}">Liste</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modification</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a class="btn btn-primary" href="{{ route('Admin.materiels.index') }}">
                    Liste des materiels
                </a>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Formulaire de Modification</h4>
            <p class="mb-30">Modifier Materiel</p>
        </div>
        <div class="wizard-content">
            <form action="{{ route('Admin.materiels.update', $materiel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" value="{{ Auth()->id() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="ordi">Type de matériel:</label>
                            <select id="question1" onchange="showHideFields1()" class="selectpicker form-control" name="ordi">
                                <option value="Ordinateur" {{ $materiel->ordi == 'Ordinateur' ? 'selected' : '' }}>Ordinateur</option>
                                <option value="Imprimante" {{ $materiel->ordi == 'Imprimante' ? 'selected' : '' }}>Imprimante</option>
                                <option value="Scanner"{{ $materiel->ordi == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marque">Marque:</label>
                            <input type="text" name="marque" id="marque" class="form-control" value="{{ old('marque', $materiel->marque) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="numero">Adresse IP ou Nom du Poste:</label>
                            <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero', $materiel->numero) }}" required>
                        </div>
                    </div>
                </div>

                {{-- Champs visibles seulement si Ordinateur --}}
                <div class="row {{ $materiel->ordi == 'Ordinateur' ? '' : 'd-none' }}" id="hiddenFields1">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="capacite">Capacité:</label>
                            <input type="text" name="capacite" id="capacite" class="form-control" value="{{ old('capacite', $materiel->capacite) }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select class="selectpicker form-control" name="type">
                                <option value="Portatif" {{ $materiel->type == 'Portatif' ? 'selected' : '' }}>Portatif</option>
                                <option value="Bureautique" {{ $materiel->type == 'Bureautique' ? 'selected' : '' }}>Bureautique</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="ram">Ram:</label>
                            <input type="text" name="ram" id="ram" class="form-control" value="{{ old('ram', $materiel->ram) }}">
                        </div>
                    </div>
                </div>

                {{-- Appartient à un personnel ? --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="apartpers">Appartient-il à un personnel ?</label>
                            <select class="selectpicker form-control" id="question2" onchange="showHideFields2()" name="apartpers">
                                <option value="oui" {{ $materiel->apartpers == 'oui' ? 'selected' : '' }}>Oui</option>
                                <option value="non" {{ $materiel->apartpers == 'non' ? 'selected' : '' }}>Non</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" id="hiddenFields2" style="{{ $materiel->apartpers == 'oui' ? '' : 'display:none' }}">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="personnel_id">Personnel:</label>
                            <select class="selectpicker form-control" name="personnel_id">
                                @foreach($personnels as $id => $entry)
                                    <option value="{{ $id }}" {{ $materiel->personnel_id == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Appartient à un site ? --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="apartsite">Appartient-il à un site ?</label>
                            <select class="selectpicker form-control" id="question3" onchange="showHideFields3()" name="apartsite">
                                <option value="oui" {{ $materiel->apartsite == 'oui' ? 'selected' : '' }}>Oui</option>
                                <option value="non" {{ $materiel->apartsite == 'non' ? 'selected' : '' }}>Non</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" id="hiddenFields3" style="{{ $materiel->apartsite == 'oui' ? '' : 'display:none' }}">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="site_id">Site:</label>
                            <select class="selectpicker form-control" name="site_id">
                                @foreach($sites as $id => $entry)
                                    <option value="{{ $id }}" {{ $materiel->site_id == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Etat --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="etat">État:</label>
                            <select class="selectpicker form-control" name="etat">
                                <option value="neuf" {{ $materiel->etat == 'neuf' ? 'selected' : '' }}>Neuf</option>
                                <option value="peu user" {{ $materiel->etat == 'peu user' ? 'selected' : '' }}>Peu usé</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <a href="{{ route('Admin.materiels.index') }}" class="btn btn-danger">Annuler</a>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showHideFields1() {
    var selectBox = document.getElementById("question1");
    var hiddenFields1 = document.getElementById("hiddenFields1");
    if (selectBox.value === "Ordinateur") {
        hiddenFields1.classList.remove("d-none");
    } else {
        hiddenFields1.classList.add("d-none");
    }
}

function showHideFields2() {
    var selectBox = document.getElementById("question2");
    var hiddenFields2 = document.getElementById("hiddenFields2");
    hiddenFields2.style.display = (selectBox.value === "oui") ? "block" : "none";
}

function showHideFields3() {
    var selectBox = document.getElementById("question3");
    var hiddenFields3 = document.getElementById("hiddenFields3");
    hiddenFields3.style.display = (selectBox.value === "oui") ? "block" : "none";
}
</script>

@endsection
