<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Oefening</title>
</head>
<body>
    <h1>Oefening Bewerken</h1>
    <form action="{{ route('oefeningen.update', $oefening->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Naam:</label><br>
        <input type="text" name="name" value="{{ $oefening->name }}" required><br><br>
        <label>Beschrijving:</label><br>
        <textarea name="description" required>{{ $oefening->description }}</textarea><br><br>
        <label>Afbeeldingspad:</label><br>
        <input type="text" name="image" value="{{ $oefening->image }}" required><br><br>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
