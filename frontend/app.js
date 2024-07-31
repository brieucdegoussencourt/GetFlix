// Function to handle the search functionality
async function searchData(event) {
    event.preventDefault();
    const query = document.getElementById('searchInput').value;
    const mediaType = document.getElementById('mediaType').value;
    console.log(`Searching for: ${query} in ${mediaType}`);
    
    try {
        const response = await fetch(`../backend/getData.php?query=${query}&media_type=${mediaType}`);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        console.log('Searched data:', data);
        displayData(data.results);
    } catch (error) {
        console.error('Error searching data:', error);
    }
}

// Function to display the fetched data in the content area
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

// Initial fetch to load data when the page loads (optional if you want to load something by default)
//fetchData();