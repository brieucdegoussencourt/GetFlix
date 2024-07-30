<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie and TV Show App</title>
    <link rel="stylesheet" href="../css/stream_style.css">
</head>
<body>
    <header>
        <h1>Movies and TV Shows</h1>
        <div>
            <select id="filter">
                <option value="movie">Movies</option>
                <option value="tv">TV Shows</option>
            </select>
            <button onclick="fetchData()">Filter</button>
        </div>
    </header>
    <main id="content">
        <!-- Movies and TV Shows will be displayed here -->
    </main>
    <script src="app.js"></script>
</body>
</html>