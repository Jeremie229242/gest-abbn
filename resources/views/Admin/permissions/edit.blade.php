@extends("layouts.master")
@section('title','GEST-PARC | Modification Permissions')
@section("contenu")

<!-- resources/views/permissions/edit.blade.php -->
<br><br><br>

    <h1>Modifier la permission : {{ $permission->name }}</h1>
<div class="card">
    

    <div class="card-body">
    <form action="{{ route('Admin.permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ $permission->slug }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        // Écouteur d'événement pour mettre à jour le champ slug à partir du champ name
        $(document).ready(function () {
            $('#name').on('input', function () {
                const name = $(this).val();
                const slug = slugify(name);
                $('#slug').val(slug);
            });
        });

        // Fonction pour générer un slug à partir d'une chaîne
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Remplace les espaces par des tirets
                .replace(/[^\w\-]+/g, '')       // Supprime tous les caractères non alphanumériques, sauf les tirets
                .replace(/\-\-+/g, '-')         // Remplace les doubles tirets par un seul tiret
                .replace(/^-+/, '')             // Supprime les tirets en début de chaîne
                .replace(/-+$/, '');            // Supprime les tirets en fin de chaîne
        }
    </script>

@endsection
