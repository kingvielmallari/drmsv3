<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./vendor/bootstrapv5/css/bootstrap.min.css">
   

</head>
<body>

<h1>test</h1>

<div id="container" class="container">
</div>

<ul id="selected-list"></ul>




<button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>


<script>
document.addEventListener("DOMContentLoaded", async () => {
  try {
    const response = await fetch('./controllers/GetDocuments.php');
    const data = await response.json();

    if (data && data.length > 0) {
      const container = document.getElementById("container");
      const selectedList = document.getElementById("selected-list");
      const selectedItems = new Set();

      data.forEach(result => {
        const button = document.createElement("button");
        button.innerText = result.name;
        button.className = "btn btn-outline-success m-2";
        button.setAttribute("data-bs-toggle", "button");
        button.setAttribute("aria-pressed", "false");

        const additionalInputs = document.createElement("div");
        additionalInputs.style.display = "none";
        additionalInputs.className = "mt-2";

        if (result.name === "Certificate of Grades" || result.name === "Certificate of Registration") {
          const yearSelect = document.createElement("select");
          yearSelect.className = "form-select mb-2";
          yearSelect.innerHTML = `
            <option value="" disabled selected>Select Year</option>
            <option value="1st">1st</option>
            <option value="2nd">2nd</option>
            <option value="3rd">3rd</option>
            <option value="4th">4th</option>
          `;

          const semSelect = document.createElement("select");
          semSelect.className = "form-select";
          semSelect.innerHTML = `
            <option value="" disabled selected>Select Semester</option>
            <option value="1st">1st</option>
            <option value="2nd">2nd</option>
          `;

          additionalInputs.appendChild(yearSelect);
          additionalInputs.appendChild(semSelect);
        }

        button.addEventListener("click", () => {
          const isActive = button.classList.contains("btn-success");

          button.classList.toggle("btn-outline-success", isActive);
          button.classList.toggle("btn-success", !isActive);
          button.setAttribute("aria-pressed", (!isActive).toString());

          if (!isActive) {
            if (additionalInputs.style.display === "block") {
              const year = additionalInputs.querySelector("select:nth-child(1)").value;
              const sem = additionalInputs.querySelector("select:nth-child(2)").value;

              if (!year || !sem) {
                alert("Please select both year and semester.");
                button.classList.toggle("btn-outline-success", !isActive);
                button.classList.toggle("btn-success", isActive);
                button.setAttribute("aria-pressed", isActive.toString());
                return;
              }

              selectedItems.add(`${result.name} - ${year}, ${sem}`);
            } else {
              selectedItems.add(result.name);
            }
          } else {
            selectedItems.forEach(item => {
              if (item.startsWith(result.name)) {
                selectedItems.delete(item);
              }
            });
          }

          selectedList.innerHTML = '';
          selectedItems.forEach(item => {
            const li = document.createElement("li");
            li.textContent = item;
            selectedList.appendChild(li);
          });

          // Show additional inputs when button is active
          if (!isActive && additionalInputs.style.display === "none") {
            additionalInputs.style.display = "block";
          } else if (isActive) {
            additionalInputs.style.display = "none";
          }
        });

        container.appendChild(button);
        container.appendChild(additionalInputs);
      });

      // 🔥 Submit Button Function
      document.getElementById("submit-btn").addEventListener("click", async () => {
        if (selectedItems.size === 0) {
          alert("No items selected.");
          return;
        }

        const selectedArray = Array.from(selectedItems);

        const submitResponse = await fetch('./controllers/SaveSelected.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ selected: selectedArray })
        });

        const result = await submitResponse.json();
        if (result.success) {
          alert("Selection submitted successfully!");
        } else {
          alert("Submission failed.");
        }
      });
    }
  } catch (error) {
    console.error('Error:', error);
  }
});

</script>





<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>