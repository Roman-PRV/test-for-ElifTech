export function removeQuestion(questionId) {
    alert(1);
    const questionElement = document.querySelector(
        `[data-question-id='${questionId}']`
    );
    if (questionElement) {
        questionElement.remove();
    }
}

export function addAnswer(questionId) {
    alert(1);
    const answersContainer = document.getElementById(`answers_${questionId}`);
    if (!answersContainer) return;

    const newAnswerDiv = document.createElement("div");
    newAnswerDiv.className = "flex items-center space-x-4 mb-2";
    newAnswerDiv.innerHTML = `
        <input type="text" name="answers[${questionId}][]" class="flex-1 p-2 border rounded-lg" placeholder="Enter answer text" />
        <button type="button" class="remove-answer bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
            Remove
        </button>
    `;

    answersContainer.appendChild(newAnswerDiv);

    const removeButton = newAnswerDiv.querySelector(".remove-answer");
    removeButton.addEventListener("click", () => {
        newAnswerDiv.remove();
    });
}

export function showAnswers(questionId, selectElement) {
    alert(1);
    const answersContainer = document.getElementById(`answers_${questionId}`);
    if (!answersContainer) return;

    if (
        selectElement.value === "single choice" ||
        selectElement.value === "multiple choice"
    ) {
        answersContainer.classList.remove("hidden");
    } else {
        answersContainer.classList.add("hidden");
    }
}
