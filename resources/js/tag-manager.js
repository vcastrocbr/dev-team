// Handle adding a new tag
document.getElementById("addTagButton").addEventListener("click", function () {
    const createTagInput = document.getElementById("create_tag");
    const tagName = createTagInput.value.trim();

    if (!tagName) {
        alert("Tag name cannot be empty.");
        return;
    }

    this.disabled = true;

    fetch("/tags", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ name: tagName }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Failed to create tag.");
            }
            return response.json();
        })
        .then((tag) => {
            const tagList = document.querySelector(".grid");
            const tagItem = document.createElement("div");
            tagItem.classList.add("flex", "items-center", "relative");
            tagItem.innerHTML = `
            <input type="checkbox" name="tags[]" value="${tag.id}" id="tag-${tag.id}" class="rounded border-gray-300 text-gray-800 shadow-sm focus:ring-gray-500">
            <label for="tag-${tag.id}" class="ml-2 text-sm text-gray-600">${tag.name}</label>
            <button class="delete-tag ml-2 text-gray-600" type="button">
                <i class="fas fa-trash-alt"></i>
            </button>
        `;
            tagList.appendChild(tagItem);
            // Clear the input field after adding the tag
            createTagInput.value = "";
            this.disabled = false;
        })
        .catch((error) => {
            alert(error.message);
            this.disabled = false;
        });
});

// Handle deleting a tag
document.addEventListener("click", function (event) {
    const deleteButton = event.target.closest(".delete-tag");

    if (deleteButton) {
        const tagItem = deleteButton.closest(".flex.items-center");
        const tagId = tagItem.querySelector("input").value;

        // Perform the DELETE request
        fetch(`/tags/${tagId}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to delete the tag.");
                }

                // Remove the tag from the DOM
                tagItem.remove();
            })
            .catch((error) => {
                alert(error.message);
            });
    }
});

// Tag Suggestions
const createTagInput = document.getElementById("create_tag");
const suggestionsContainer = document.createElement("div");
suggestionsContainer.classList.add(
    "suggestions-container",
    "absolute",
    "bg-white",
    "shadow-md",
    "rounded-md",
    "z-10"
);

createTagInput.parentElement.classList.add("relative");
createTagInput.parentElement.appendChild(suggestionsContainer);

suggestionsContainer.style.top = `${createTagInput.offsetHeight + 10}px`;
suggestionsContainer.style.left = "0";

// Listen for input changes to filter tag names
createTagInput.addEventListener("input", function () {
    const searchTerm = createTagInput.value.trim();
    if (searchTerm.length > 0) {
        filterTags(searchTerm);
    } else {
        clearSuggestions();
    }
});

// Filter tags based on the input
function filterTags(query) {
    // Use the tag names array passed from the server
    const filteredTags = tags.filter((tag) =>
        tag.toLowerCase().startsWith(query.toLowerCase())
    );

    displaySuggestions(filteredTags);
}

// Display the filtered suggestions
function displaySuggestions(filteredTags) {
    clearSuggestions(); // Clear any existing suggestions
    if (filteredTags.length > 0) {
        filteredTags.forEach((tag) => {
            const suggestionItem = document.createElement("div");
            suggestionItem.classList.add(
                "suggestion-item",
                "px-4",
                "py-2",
                "cursor-pointer",
                "hover:bg-gray-200"
            );
            suggestionItem.textContent = tag;
            suggestionItem.addEventListener("click", () => selectTag(tag));
            suggestionsContainer.appendChild(suggestionItem);
        });
    }
}

// Select a tag from the suggestions
function selectTag(tag) {
    // Set the input value to the selected tag's name
    createTagInput.value = tag;
    clearSuggestions(); // Clear suggestions once a tag is selected
}

// Clear suggestions
function clearSuggestions() {
    suggestionsContainer.innerHTML = ""; // Clear the suggestions container
}
