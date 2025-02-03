
function fetchData(endpoint) {
    return fetch(`https://dummyapi.com/${endpoint}?api_key=${API_KEY}`)
        .then(response => response.json())
        .then(data => console.log("Fetched Data:", data))
        .catch(error => console.error("Error fetching data:", error));
}

// Example usage
fetchData("users");
