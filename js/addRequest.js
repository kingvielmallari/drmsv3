// show sem and year when cor/cog was clicked
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

// back and next function
document.addEventListener('DOMContentLoaded', function () {
  const steps = document.querySelectorAll('.step');
  const stepCircles = document.querySelectorAll('.circle');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  let currentStep = 0;

  function updateStepper(stepIndex) {
    stepCircles.forEach((circle, index) => {
      if (index <= stepIndex) {
        circle.classList.add('active');
      } else {
        circle.classList.remove('active');
      }
    });
  }

  function showStep(stepIndex) {
    steps.forEach((step, index) => {
      step.style.display = index === stepIndex ? 'block' : 'none';
    });

    // Update button visibility and behavior
    if (stepIndex === 0) {
      prevBtn.style.display = 'inline-block';
      prevBtn.textContent = 'Cancel';
      prevBtn.onclick = function () {
        window.location.href = '/drmsv3/dashboard.php';
      };
    } else {
      prevBtn.style.display = 'inline-block';
      prevBtn.textContent = 'Back';
      prevBtn.onclick = function () {
        currentStep--;
        showStep(currentStep);
        updateStepper(currentStep);
      };
    }

    nextBtn.textContent = stepIndex === steps.length - 1 ? 'Finish' : 'Next';
    nextBtn.onclick = function () {
      if (currentStep < steps.length - 1) {
        currentStep++;
        showStep(currentStep);
        updateStepper(currentStep);
      }
    };

    updateStepper(stepIndex);
  }

  prevBtn.onclick = function () {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
      updateStepper(currentStep);
    } else {
      window.location.href = '/drmsv3/dashboard.php';
    }
  };

  nextBtn.onclick = function () {
    if (currentStep < steps.length - 1) {
      currentStep++;
      showStep(currentStep);
      updateStepper(currentStep);
    }
  };

  showStep(currentStep);
});

