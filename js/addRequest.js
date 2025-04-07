
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.document-toggle');
    buttons.forEach(button => {
      button.addEventListener('click', function () {
        const docId = this.getAttribute('data-doc-id');
        const requiresYearSem = this.getAttribute('data-requires-year-sem') === 'true';
        const hiddenInput = document.getElementById('doc_' + docId);
        const yearSemInputs = document.getElementById('year_sem_' + docId);

        if (this.classList.contains('btn-success')) {
          this.classList.remove('btn-success', 'active');
          this.classList.add('btn-outline-success');
          hiddenInput.value = '';
          if (requiresYearSem) {
            yearSemInputs.style.display = 'none';
          }
        } else {
          this.classList.remove('btn-outline-success');
          this.classList.add('btn-success', 'active');
          hiddenInput.value = docId;
          if (requiresYearSem) {
            yearSemInputs.style.display = 'block';
          }
        }
      });
    });
  });
  
  
  
  document.addEventListener('DOMContentLoaded', function () {
    const selectedDocumentsContainer = document.getElementById('selectedDocuments');
    const documentButtons = document.querySelectorAll('.document-toggle');

    function updateSelectedDocuments() {
      const selectedDocs = Array.from(documentButtons)
        .filter(button => button.classList.contains('btn-success'))
        .map(button => {
          const docId = button.getAttribute('data-doc-id');
          const docName = button.textContent.trim();
          const requiresYearSem = button.getAttribute('data-requires-year-sem') === 'true';
          let yearSemDetails = '';

          if (requiresYearSem) {
            const year = document.getElementById('year_' + docId)?.value || '';
            const sem = document.getElementById('sem_' + docId)?.value || '';
            yearSemDetails = ` (${year} - ${sem})`;
          }

          return { docId, docName, yearSemDetails };
        });

      if (selectedDocs.length === 0) {
        selectedDocumentsContainer.innerHTML = '<p class="text-muted">No documents selected yet.</p>';
      } else {
        selectedDocumentsContainer.innerHTML = '<ul class="list-group">';
        selectedDocs.forEach(doc => {
          fetch(`fetch_price.php?doc_id=${doc.docId}`)
            .then(response => response.json())
            .then(data => {
              const price = data.price || 'N/A';
              const listItem = document.createElement('li');
              listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
              listItem.innerHTML = `
                ${doc.docName}${doc.yearSemDetails}
                <span class="badge bg-success rounded-pill">₱${price}</span>
              `;
              selectedDocumentsContainer.querySelector('ul').appendChild(listItem);
            })
            .catch(error => console.error('Error fetching price:', error));
        });
      }
    }

    documentButtons.forEach(button => {
      button.addEventListener('click', updateSelectedDocuments);
    });

    document.querySelectorAll('.year-sem-inputs select').forEach(select => {
      select.addEventListener('change', updateSelectedDocuments);
    });
  });
  
  
// next step button

let currentStep = 0;
const steps = document.querySelectorAll(".step");
const stepCircles = document.querySelectorAll(".circle");

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle("active", i === index);
    stepCircles[i].classList.remove("active", "completed");
    if (i < index) {
      stepCircles[i].classList.add("completed");
    } else if (i === index) {
      stepCircles[i].classList.add("active");
    }
  });

  document.getElementById("prevBtn").style.display = index === 0 ? "none" : "inline-block";
  document.getElementById("nextBtn").style.display = index === steps.length - 1 ? "none" : "inline-block";
}

document.getElementById("nextBtn").addEventListener("click", () => {
  if (currentStep < steps.length - 1) {
    currentStep++;
    showStep(currentStep);
  }
});

document.getElementById("prevBtn").addEventListener("click", () => {
  if (currentStep > 0) {
    currentStep--;
    showStep(currentStep);
  }
});

document.getElementById("multiStepForm").addEventListener("submit", (e) => {
  e.preventDefault();
  alert("Form submitted!");
});

// Initial state
showStep(currentStep);