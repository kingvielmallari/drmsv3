 // AJAX submission
 document.getElementById('addRequestForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  if (!validateStep(currentStep)) return;
  
// Get all selected document names with additional inputs for COG and COR
const selectedDocs = Array.from(document.querySelectorAll('.document-toggle.active')).map(button => {
  const docName = button.getAttribute('data-doc-name');
  const docId = button.getAttribute('data-doc-id');
  const yearInput = document.getElementById(`year-${docId}`);
  const semInput = document.getElementById(`sem-${docId}`);
  
  if (yearInput && semInput && yearInput.value && semInput.value) {
    return `${docName} (${yearInput.value}, ${semInput.value})`;
  }
  return docName;
}).join(', '); // Combine into a single string

  // Prepare form data
  const formData = new FormData();
  
  // Add student info
  formData.append('student_id', document.getElementById('summaryStudentId').textContent.trim());
  formData.append('student_name', document.getElementById('summaryStudentName').textContent.trim());
  formData.append('program_section', document.getElementById('summaryProgramSection').textContent.trim());
  
  // Add selected documents (single field for all docs)
  formData.append('document_request', selectedDocs);
  
  // Add other form data
  formData.append('delivery_option', document.getElementById('delivery_option').value);
  formData.append('appointment_date', document.getElementById('appointment_date').value);
  formData.append('appointment_time', document.getElementById('appointment_time').value);
  
  // Calculate total price
  const totalPrice = selectedDocuments.reduce((sum, doc) => sum + doc.price, 0) + parseFloat(systemFee);

  formData.append('total_price', totalPrice.toFixed(2));

  
  
  // Submit via AJAX
  fetch('../controllers/AddRequest.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Request submitted successfully!');
      // Redirect or show success message
      window.location.href = 'request-success.php?request_id=' + data.request_id;
    } else {
      alert('Error: ' + (data.message || 'Failed to submit request'));
    }
  })
.catch(error => {
  console.error('Error:', error);
  alert('An error occurred while submitting your request.');
});
});


// Change Theme
document.getElementById('themeToggle').addEventListener('change', function() {
  if (this.checked) {
      document.documentElement.setAttribute('data-bs-theme', 'dark');
      document.cookie = "theme=dark; path=/; SameSite=Strict";
  } else {
      document.documentElement.removeAttribute('data-bs-theme');
      document.cookie = "theme=light; path=/; SameSite=Strict";
  }
});


// Load Theme from Cookie
window.addEventListener('load', function() {
  const theme = document.cookie.split(';').find((item) => item.trim().startsWith('theme='));
  if (theme) {
      const themeValue = theme.split('=')[1];
      if (themeValue === 'dark') {
          document.documentElement.setAttribute('data-bs-theme', 'dark');
          document.getElementById('themeToggle').checked = true;
      } else {
          document.documentElement.removeAttribute('data-bs-theme');
          document.getElementById('themeToggle').checked = false;
      }
  }
});