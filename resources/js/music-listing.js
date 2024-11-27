// Get references to the search input and music list
const searchInput = document.getElementById("search");
const musicList = document.getElementById("music-list");
const musicItems = musicList.getElementsByClassName("music-item");

// Listen for input events on the search field
searchInput.addEventListener("input", function () {
    const searchQuery = searchInput.value.toLowerCase();

    // Loop through each music item
    Array.from(musicItems).forEach((item) => {
        const title = item.querySelector("a").textContent.toLowerCase();
        const artist = item.querySelector("span").textContent.toLowerCase();
        const tags = item.getAttribute("data-tags").toLowerCase();

        // If title, artist, or any tag matches the search query, show the item, otherwise hide it
        if (
            title.includes(searchQuery) ||
            artist.includes(searchQuery) ||
            tags.includes(searchQuery)
        ) {
            item.style.display = ""; // Show item
        } else {
            item.style.display = "none"; // Hide item
        }
    });
});
