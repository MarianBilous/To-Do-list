document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".generate-link-btn").forEach(button => {
        button.addEventListener("click", async function () {
            let taskId = this.getAttribute("data-task-id");
            let url = `/tasks/${taskId}/generate-link`;
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            try {
                let response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    }
                });

                let data = await response.json();

                if (data.url) {
                    let textarea = document.createElement("textarea");
                    textarea.value = data.url;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand("copy");
                    document.body.removeChild(textarea);

                    alert("Link copied to clipboard!");
                } else {
                    alert("Error generating link.");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Failed to generate link.");
            }
        });
    });
});
