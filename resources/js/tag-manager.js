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
            
            <button class="delete-tag ml-2 text-gray-600">
                <i class="fas fa-trash-alt"></i>
            </button>
        `;
            tagList.appendChild(tagItem);

            createTagInput.value = "";
            this.disabled = false;
        })
        .catch((error) => {
            alert(error.message);
            this.disabled = false;
        });
});

// Listen for the deletion of tags
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
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
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
