export function addAnswer(questionId) {
    const requestData = {
        question_id: questionId,
        answer: "Some text",
    };

    fetch(`/answers`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify(requestData),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.success) {
                const answersContainer = document.getElementById(
                    `add-answer-button-container-${questionId}`
                );
                answersContainer.insertAdjacentHTML("beforebegin", data.html); // Вставляємо HTML в контейнер

                attachListenersToAnswer(data.answerId);

                alert("New answer created successfully!");
            } else {
                alert("Failed to create a new answer.");
                if (data.error) {
                    console.error("Server error:", data.error);
                }
            }
        })
        .catch((error) => {
            console.error("Error creating answer:", error);
            alert("An error occurred while creating the answer.");
        });
}

export function removeAnswer(answerId) {
    const confirmation = confirm(
        "Are you sure you want to delete this answer?"
    );
    if (!confirmation) return;

    const answerElement = document.querySelector(
        `[data-answer-id="${answerId}"]`
    );
    answerElement.remove();

    alert("Answer deleted successfully!");
}

function attachListenersToAnswer(answerId) {
    const answerElement = document.querySelector(
        `[data-answer-id='${answerId}']`
    );

    const removeButton = answerElement.querySelector(".remove-answer-button");
    removeButton.addEventListener("click", () => {
        removeAnswer(answerId);
    });

    
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".remove-answer-button").forEach((button) => {
        button.addEventListener("click", function () {
            const answerId = this.closest("[data-answer-id]").dataset.answerId;
            removeAnswer(answerId);
        });
    });

    document.querySelectorAll(".add-answer-button").forEach((button) => {
        button.addEventListener("click", function () {
            const questionId =
                this.closest("[data-question-id]").dataset.questionId;
            addAnswer(questionId);
        });
    });
});
