<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Oefening</title>
</head>
<body>
    <h1>Nieuwe Oefening</h1>
    <form action="{{ route('oefeningen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Naam:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Beschrijving:</label><br>
        <textarea name="description" required></textarea><br><br>

        <label>Afbeelding:</label><br>
        <input type="file" name="image" accept="image/*" required><br><br>

        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
