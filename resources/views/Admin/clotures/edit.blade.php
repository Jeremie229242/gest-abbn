@extends("layouts.master")
@section('title','GEST-APP | Modification de Maintenance')
@section("contenu")

<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Modifier une maintenance</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="\">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.maintenances.index') }}">Liste</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modification</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-primary" href="{{ route('Admin.maintenances.index') }}">
                        Liste Maintenances
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Formulaire de Modification</h4>
            <p class="mb-30">Modifier une maintenance existante</p>
        </div>

        <div class="wizard-content">
            <form action="{{ route('Admin.maintenances.update', $maintenance->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input hidden class="form-control" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">

                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date_panne">Date Panne:</label>
                                <input type="date" name="date_panne" id="date_panne"
                                       class="form-control"
                                       value="{{ old('date_panne', $maintenance->date_panne) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="motif">Motif:</label>
                                <input type="text" name="motif" id="motif"
                                       class="form-control"
                                       value="{{ old('motif', $maintenance->motif) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="materiel_id">Matériel:</label>
                                <select class="selectpicker form-control" name="materiel_id">


                                    @foreach($materiels as $id => $entry)
                                    <option value="{{ $id }}" {{ $maintenance->materiel_id == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Réparations --}}
                    <div class="row" id="fieldsContainer">
                        @php
                            $reparations = old('reparation', $maintenance->reparation ?? []);
                        @endphp

                        @foreach ($reparations as $index => $rep)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reparation_{{ $index }}">Détail reparation:(appuyer sur le + pour ajouter chaque ligne de detail)</label>
                                    <input type="text" name="reparation[]"
                                           id="reparation_{{ $index }}"
                                           class="form-control"
                                           value="{{ $rep }}" required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-info" onclick="addMoreFields()">+</button>
                </section>

                <div class="modal-footer justify-content-center">
                    <a type="button" href="{{ route('Admin.maintenances.index') }}" class="btn btn-danger">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
  let fieldIndex = {{ count($reparations) }};

  function addMoreFields() {
      let fieldsContainer = document.getElementById('fieldsContainer');
      let newFieldsDiv = document.createElement('div');
      newFieldsDiv.innerHTML = `
          <div class="col-md-12">
              <div class="form-group">
                  <label for="reparation_${fieldIndex}">Détail réparation:</label>
                  <input type="text" name="reparation[]" id="reparation_${fieldIndex}" class="form-control" required>
              </div>
          </div>
      `;
      fieldsContainer.appendChild(newFieldsDiv);
      fieldIndex++;
  }
</script>
@endsection
