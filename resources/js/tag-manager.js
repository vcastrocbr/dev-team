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
                return response.json().then((data) => {
                    if (data.errors) {
                        // Assuming 'create_tag' is the name of the input
                        const createTagError = document.querySelector('.x-input-error');
                        createTagError.innerHTML = data.errors.name ? data.errors.name[0] : '';
                    } else {
                        alert("Failed to create tag.");
                    }
                });
            }
            return response.json();
        })
        .then((tag) => {
            const tagList = document.querySelector(".grid");
            const tagItem = document.createElement("div");
            tagItem.classList.add("flex", "items-center");
            tagItem.innerHTML = `
            <input type="checkbox" name="tags[]" value="${tag.id}" id="tag-${tag.id}" class="rounded border-gray-300 text-gray-800 shadow-sm focus:ring-gray-500">
            <label for="tag-${tag.id}" class="ml-2 text-sm text-gray-600">${tag.name}</label>
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
