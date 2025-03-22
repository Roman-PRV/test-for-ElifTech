// Функція для збереження питання
import { addAnswer } from "./answers";

export function removeQuestion(questionId) {
    const confirmation = confirm(
        "Are you sure you want to remove this question?"
    );
    if (!confirmation) return;

    const questionContainer = document.querySelector(
        `[data-question-id='${questionId}']`
    );
    questionContainer.remove();
}

export function showAnswers(event) {
    const selectElement = event.target;
    const questionId = selectElement.dataset.questionId;
    const container = document.getElementById(
        `answers-container-${questionId}`
    );

    if (selectElement.value === "2" || selectElement.value === "3") {
        container.classList.remove("hidden");
    } else {
        container.classList.add("hidden");
    }
}

export function createQuestion(quizId) {
    const defaultData = {
        question: "Some text",
        type_id: 1,
        quiz_id: quizId,
    };

    fetch("/questions", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify(defaultData),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                const formContainer = document.querySelector(
                    "#questions-form-container"
                );
                formContainer.insertAdjacentHTML("beforeend", data.html);

                attachListenersToQuestion(data.questionId);

                alert("New question created successfully!");
            } else {
                alert("Failed to create a new question.");
                if (data.error) {
                    console.error("Server error:", data.error);
                }
            }
        })
        .catch((error) => {
            console.error("Error creating question:", error);
            alert("An error occurred while creating the question.");
        });
}

function attachListenersToQuestion(questionId) {
    const questionElement = document.querySelector(
        `[data-question-id='${questionId}']`
    );

    const removeButton = questionElement.querySelector(
        ".remove-question-button"
    );
    removeButton.addEventListener("click", () => {
        removeQuestion(questionId);
    });

    const typeSelect = questionElement.querySelector(".type-select");
    typeSelect.addEventListener("change", showAnswers);

    questionElement
        .querySelector(".add-answer-button")
        .addEventListener("click", function () {
            addAnswer(questionId);
        });
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".remove-question-button").forEach((button) => {
        button.addEventListener("click", function () {
            const questionId =
                this.closest("[data-question-id]").dataset.questionId;
            removeQuestion(questionId);
        });
    });

    document.querySelectorAll(".type-select").forEach((select) => {
        select.addEventListener("change", showAnswers);
    });

    const addQuestionButton = document.getElementById("add-question-button");
    if (addQuestionButton) {
        addQuestionButton.addEventListener("click", () => {
            const quizId = addQuestionButton.dataset.quizId; // Отримуємо quizId із кнопки
            createQuestion(quizId);
        });
    }
});
