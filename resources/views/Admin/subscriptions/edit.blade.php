@extends("layouts.master")
@section('title','GEST-APP | Modification Abonnement')
@section("contenu")

<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Modifier Abonnement</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="\">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.subscriptions.index') }}">Liste</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modification</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-primary" href="{{ route('Admin.subscriptions.index') }}">
                        Liste Maintenances
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Formulaire de Modification</h4>
            <p class="mb-30">Modifier Abonnement existant</p>
        </div>

        <div class="wizard-content">
            <form action="{{ route('Admin.subscriptions.update', $sub->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input hidden class="form-control" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">

                <section>
                            <input hidden class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">

								<div class="row">

									<div class="col-md-6">
                                    <div class="form-group">
            <label for="name">Nom Abonnement:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $sub->name) }}" required>

        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="name">Entite:</label>
            <input type="text" name="entity" id="entity" value="{{ old('entity', $sub->entity) }}" class="form-control" required>

        </div>
									</div>
                                </div>

                                <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="subscription_date">Date début Abonnement:</label>
            <input
                type="date"
                name="subscription_date"
                id="subscription_date"
                class="form-control"
                value="{{ old('subscription_date', \Carbon\Carbon::parse($sub->subscription_date)->format('Y-m-d')) }}"
                required
            >
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="expiration_date">Date fin Abonnement:</label>
            <input
                type="date"
                name="expiration_date"
                id="expiration_date"
                class="form-control"
                value="{{ old('expiration_date', \Carbon\Carbon::parse($sub->expiration_date)->format('Y-m-d')) }}"
                min="{{ old('subscription_date', \Carbon\Carbon::parse($sub->subscription_date)->format('Y-m-d')) }}"
                required
            >
        </div>
    </div>
</div>


                                <div class="row">

<div class="col-md-6">
<div class="form-group">
<label for="remind_before_days">Nbre de jour de rappel avant La date d'expiration:</label>
<input type="number" value="{{ old('remind_before_days', $sub->remind_before_days) }}" name="remind_before_days" id="remind_before_days" class="form-control" required>


</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="expiration_date">Typre abonnement:</label>
<select class="selectpicker form-control" name="type" required>
        <option value="licence" {{ old('type', $sub->type) == 'licence' ? 'selected' : '' }}>Licence</option>
        <option value="internet" {{ old('type', $sub->type) == 'internet' ? 'selected' : '' }}>Internet</option>
    </select>
</div>
</div>
</div>

<!-- <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Document</label>

            {{-- Si un fichier existe déjà, on l’affiche --}}
            @if ($sub->file_path)
                <p>
                    <a href="{{ Storage::url($sub->file_path) }}" target="_blank" class="text-primary">
                        📂 Voir le document actuel
                    </a>
                </p>
            @endif

            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input">
                <label class="custom-file-label">Choisir un fichier (optionnel)</label>
            </div>
        </div>
    </div>
</div> -->



<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Document</label>

            {{-- Si un fichier existe déjà --}}
            @if ($sub->file_path)
    <p>📂 Fichier actuel :</p>

    @if (Str::endsWith($sub->file_path, ['.png', '.jpg', '.jpeg', '.gif']))
        <img src="{{ asset('storage/'.$sub->file_path) }}"
             alt="Document"
             class="img-fluid rounded shadow"
             style="max-width: 300px;">
    @else
        <a href="{{ route('Admin.subscriptions.download', $sub->id) }}" class="btn btn-sm btn-primary">
            📥 Télécharger le document
        </a>
    @endif
@endif


            {{-- Input pour changer le fichier --}}
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input">
                <label class="custom-file-label">Choisir un fichier (optionnel)</label>
            </div>
        </div>
    </div>
</div>


<div class="row">
<div class="col-md-12">
<div class="form-group">
    <label>Email de rappel:</label>
    <select name="emails[]" id="emails" class="selectpicker form-control" multiple>
        @foreach(\App\Models\Email::all() as $email)
            <option value="{{ $email->email }}"
                @if(isset($sub) && $sub->emails->contains('email', $email->email)) selected @endif>
                {{ $email->email }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Maintenez CTRL (ou CMD sur Mac) pour sélectionner plusieurs emails</small>
</div>
</div>
</div>

<div class="form-group mt-3">
    <label for="new_emails">Nouveaux emails (séparés par des virgules) :</label>
    <input type="text" name="new_emails" id="new_emails" class="form-control"
           placeholder="ex: test1@mail.com, test2@mail.com">
    <small class="text-muted">Tu peux entrer plusieurs emails séparés par une virgule</small>
</div>
							</section>

                <div class="modal-footer justify-content-center">
                    <a type="button" href="{{ route('Admin.subscriptions.index') }}" class="btn btn-danger">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
