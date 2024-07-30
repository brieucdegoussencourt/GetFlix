async function fetchData() {
    const filter = document.getElementById('filter').value;
    console.log(`Fetching data for type: ${filter}`);
    
    try {
        const response = await fetch(`../backend/getData.php?type=${filter}`);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        console.log('Fetched data:', data);
        displayData(data.results); // Ensure to access the 'results' key if the API response contains it
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

function displayData(data) {
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

// Initial fetch
fetchData();