// Async function to fetch data based on the selected filter
async function fetchData() {
    // Get the value of the filter input element and logging it
    const filter = document.getElementById('filter').value;
    console.log(`Fetching data for type: ${filter}`);
    
    try {
        // Fetch data from the backend API with the filter as a query parameter
        const response = await fetch(`../backend/getData.php?type=${filter}`);
        // Check if the response is not okay (HTTP status not in the range 200-299)
        if (!response.ok) {
            // Throw an error with the HTTP status if the response is not okay
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Parse the response data as JSON
        const data = await response.json();
        console.log('Fetched data:', data);
        // Display the fetched data using the displayData function
        displayData(data.results); // Ensure to access the 'results' key if the API response contains it
    } catch (error) {
        // Log any errors that occur during the fetch process
        console.error('Error fetching data:', error);
    }
}

// Function to handle the search functionality
async function searchData(event) {
    event.preventDefault(); // Prevent the form from submitting in the traditional way
    const query = document.getElementById('searchInput').value;
    console.log(`Searching for: ${query}`);
    
    try {
        // Fetch data from the backend API with the search query as a parameter
        const response = await fetch(`../backend/getData.php?query=${query}`);
        // Check if the response is not okay (HTTP status not in the range 200-299)
        if (!response.ok) {
            // Throw an error with the HTTP status if the response is not okay
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Parse the response data as JSON
        const data = await response.json();
        console.log('Searched data:', data);
        // Display the fetched data using the displayData function
        displayData(data.results); // Ensure to access the 'results' key if the API response contains it
    } catch (error) {
        // Log any errors that occur during the fetch process
        console.error('Error searching data:', error);
    }
}

// Function to display the fetched data in the content area
function displayData(data) {
    // Get the content element where the data will be displayed
    const content = document.getElementById('content');
    // Clear any existing content
    content.innerHTML = '';
    // Iterate over the fetched data items
    data.forEach(item => {
        // Create a new div element for each item
        const card = document.createElement('div');
        card.className = 'movie-card';
        // Set the inner HTML of the card with the item details
        card.innerHTML = `
            <img src="https://image.tmdb.org/t/p/w500${item.poster_path}" alt="${item.title || item.name}">
            <h3>${item.title || item.name}</h3>
            <p>Genre: ${item.genre_ids.join(', ')}</p>
            <p>Duration: ${item.runtime || (item.episode_run_time && item.episode_run_time[0]) ? item.runtime || item.episode_run_time[0] + ' min' : 'N/A'}</p>
        `;
        // Append the card to the content element
        content.appendChild(card);
    });
}

// Initial fetch to load data when the page loads
fetchData();