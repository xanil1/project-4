<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Oefening</title>
</head>
<body>
    <h1>Oefening Bewerken</h1>
    <form action="{{ route('oefeningen.update', $oefening->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Naam en beschrijving -->
        <label>Naam:</label><br>
        <input type="text" name="name" value="{{ $oefening->name }}" required><br><br>

        <label>Beschrijving:</label><br>
        <textarea name="description" required>{{ $oefening->description }}</textarea><br><br>

        <!-- Afbeelding -->
        <label>Afbeelding:</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <!-- Huidige afbeelding -->
        @if($oefening->image)
        <div>
            <label>Huidige Afbeelding:</label><br>
            <img src="{{ asset($oefening->image) }}" alt="{{ $oefening->name }}" width="25%"><br><br>
        </div>
    @endif



        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
