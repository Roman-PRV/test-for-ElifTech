import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

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
                Toastify({
                    text: "New answer created successfully!",
                    backgroundColor: "green",
                }).showToast();
            } else {
                Toastify({
                    text: "Failed to create a new answer.",
                    backgroundColor: "red",
                }).showToast();

                if (data.error) {
                    console.error("Server error:", data.error);
                }
            }
        })
        .catch((error) => {
            console.error("Error creating answer:", error);
            Toastify({
                text: "An error occurred while creating the answer.",
                backgroundColor: "red",
            }).showToast();
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
    Toastify({
        text: "Answer deleted successfully!",
        backgroundColor: "green",
    }).showToast();
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
