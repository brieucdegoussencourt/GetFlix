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
        displayData(data.results);
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
            <img src="https://image.tmdb.org/t/p/w500${item.poster_path}" alt="${item.title || item.name}">
            <h3>${item.title || item.name}</h3>
            <p>Genre: ${item.genre_ids.join(', ')}</p>
            <p>Duration: ${item.runtime || (item.episode_run_time && item.episode_run_time[0]) ? item.runtime || item.episode_run_time[0] + ' min' : 'N/A'}</p>
        `;
        content.appendChild(card);
    });
}