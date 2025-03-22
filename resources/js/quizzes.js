export function deleteQuiz(quizId, quizElement) {
    const confirmation = confirm("Are you sure you want to delete this quiz?");
    if (!confirmation) return;

    fetch(`/quizzes/${quizId}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                quizElement.remove();
                alert("Quiz deleted successfully!");
            } else {
                alert("Failed to delete quiz.");
                if (data.error) {
                    console.error("Error from server:", data.error);
                }
            }
        })
        .catch((error) => {
            console.error("Error deleting quiz:", error);
            alert("An error occurred while deleting the quiz.");
        });
}

export function runQuiz(quizId) {
    fetch("/completions", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ quiz_id: quizId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                window.location.href = `/completions/${data.completion_id}}/edit`;
            } else {
                alert("Failed to create completion.");
                console.error("Error from server:", data.error);
            }
        })
        .catch((error) => {
            console.error("Error creating completion:", error);
            alert("An error occurred while creating the completion.");
        });
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".quiz-container").forEach((quizContainer) => {
        const deleteButton = quizContainer.querySelector(".quiz-deletу-button");
        deleteButton.addEventListener("click", function (event) {
            event.preventDefault();
            const quizId = quizContainer.dataset.quizId;
            console.log(quizId);
            if (!quizId) {
                alert("Quiz ID not found.");
                return;
            }
            deleteQuiz(quizId, quizContainer);
        });

        const runButton = quizContainer.querySelector(".quiz-run-button");
        runButton.addEventListener("click", function (event) {
            event.preventDefault();
            const quizId = quizContainer.dataset.quizId;
            console.log(quizId);
            if (!quizId) {
                alert("Quiz ID not found.");
                return;
            }
            runQuiz(quizId);
        });
    });
});
