import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
import { askPermission } from "./heplers";

export function deleteQuiz(quizId, quizElement) {
    console.log(quizId);

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
                Toastify({
                    text: data.message,
                    backgroundColor: "green",
                }).showToast();
            } else {
                Toastify({
                    text: "Failed to delete quiz.",
                    backgroundColor: "red",
                }).showToast();
                if (data.error) {
                    console.error("Error from server:", data.error);
                }
            }
        })
        .catch((error) => {
            console.error("Error deleting quiz:", error);
            Toastify({
                text: "An error occurred while deleting the quiz.",
                backgroundColor: "red",
            }).showToast();
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
                Toastify({
                    text: "Failed to create completion.",
                    backgroundColor: "red",
                }).showToast();
                console.error("Error from server:", data.error);
            }
        })
        .catch((error) => {
            console.error("Error creating completion:", error);
            Toastify({
                text: "An error occurred while creating the completion.",
                backgroundColor: "red",
            }).showToast();
        });
}

function submitQuizForm() {
    const form = document.getElementById("quiz-form");
    const formData = new FormData(form);

    const formObject = {};
    formData.forEach((value, key) => {
        const keys = key.split("[").map((k) => k.replace("]", ""));
        let current = formObject;

        keys.forEach((k, i) => {
            if (i === keys.length - 1) {
                current[k] = value;
            } else {
                current[k] = current[k] || {};
                current = current[k];
            }
        });
    });

    fetch(form.action, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify(formObject),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                Toastify({
                    text: data.message,
                    backgroundColor: "green",
                }).showToast();
            } else {
                Toastify({
                    text: "Error: " + data.message,
                    backgroundColor: "red",
                }).showToast();
                console.error(data.error);
            }
        })
        .catch((error) => {
            Toastify({
                text: "An unexpected error occurred. Please try again.",
                backgroundColor: "red",
            }).showToast();
            console.error("Fetch error:", error);
        });
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".quiz-container").forEach((quizContainer) => {
        const deleteButton = quizContainer.querySelector(".quiz-deletу-button");
        deleteButton.addEventListener("click", function (event) {
            event.preventDefault();
            const quizId = quizContainer.dataset.quizId;
            if (!quizId) {
                Toastify({
                    text: "Quiz ID not found.",
                    backgroundColor: "red",
                }).showToast();
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
                Toastify({
                    text: "Quiz ID not found.",
                    backgroundColor: "red",
                }).showToast();
                return;
            }
            runQuiz(quizId);
        });
    });

    const submitButton = document.getElementById("submit-questions-button");
    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault(); // Запобігаємо стандартній поведінці кнопки
            submitQuizForm(); // Викликаємо функцію submitQuizForm
        });
    }
});
