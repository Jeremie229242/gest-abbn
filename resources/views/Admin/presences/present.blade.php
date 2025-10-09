<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des présences par équipe</title>
</head>
<body>
    <h1>Récapitulatif des présences par équipe pour le mois donné</h1>

    @foreach($recap_par_equipe as $equipe_id => $membres)
    <h2>Équipe ID: {{ $equipe_id }}</h2>

    <table>
        <thead>
            <tr>
                <th>Membre ID</th>
                <th>Nombre de présences</th>
            </tr>
        </thead>
        <tbody>
            @foreach($membres as $membre)
            <tr>
                <td>{{ $membre['membre_id'] }}</td>
                <td>{{ $membre['nb_presence'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</body>
</html>
