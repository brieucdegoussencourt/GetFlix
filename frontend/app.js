console.log('app.js loaded'); // Check if JS is loaded

async function searchData(event) {
    event.preventDefault(); // Prevent form from submitting
    console.log('Search button clicked'); // Debugging

    const query = document.getElementById('searchInput').value;
    const mediaType = document.getElementById('mediaType').value;
    console.log(`Query: ${query}, Media Type: ${mediaType}`); // Debugging

    const url = `./backend/getData.php?query=${encodeURIComponent(query)}&media_type=${encodeURIComponent(mediaType)}`;
    console.log(`Fetching data from: ${url}`); // Debugging

    try {
        const response = await fetch(url);
        console.log('Response received'); // Debugging

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Data fetched:', data); // Debugging

        // Fetch trailer links for each movie
        const moviesWithTrailers = await Promise.all(data.results.map(async (movie) => {
            const trailerUrl = `https://api.themoviedb.org/3/movie/${movie.id}/videos?api_key=a2e04e780120a2bd372881b15bb83024`;
            const trailerResponse = await fetch(trailerUrl);
            const trailerData = await trailerResponse.json();
            const trailer = trailerData.results ? trailerData.results.find(video => video.type === 'Trailer' && video.site === 'YouTube') : null;
            movie.trailerLink = trailer ? `https://www.youtube.com/watch?v=${trailer.key}` : null;
            return movie;
        }));

        displayData(moviesWithTrailers);
    } catch (error) {
        console.error('Error searching data:', error);
    }
}

function displayData(data) {
    console.log('Displaying data', data); // Debugging
    const content = document.getElementById('content');
    content.innerHTML = '';
    data.forEach(item => {
        const card = document.createElement('div');
        card.className = 'movie-card';
        card.innerHTML = `
             <div class="image-container">
                <img src="https://image.tmdb.org/t/p/w500${item.poster_path}" alt="${item.title || item.name}">
                <button id="play-button" ${item.trailerLink ? `onclick="window.open('${item.trailerLink}', '_blank')"` : ''}><img src="./images/play_circle_red.png" alt="Play Icon"></button>
            </div>
            <h3>${item.title || item.name}</h3>   
            <p>Year: ${item.year}</p>
        `;
        content.appendChild(card);
    });
}