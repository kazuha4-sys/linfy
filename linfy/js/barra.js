    // Filtro por preço
    const priceFilter = document.getElementById("priceFilter");
    const priceDisplay = document.getElementById("priceDisplay");

    priceFilter.addEventListener("input", function () {
      const maxPrice = parseFloat(priceFilter.value);
      priceDisplay.textContent = `Até R$${maxPrice}`;

      // Filtrar cursos com base no preço
      const courses = document.querySelectorAll(".course");
      courses.forEach(course => {
        const price = parseFloat(course.getAttribute("data-price"));
        if (price <= maxPrice) {
          course.style.display = "block";
        } else {
          course.style.display = "none";
        }
      });
    });

    // Filtro por categoria
    const categorySelect = document.getElementById("categorySelect");

    categorySelect.addEventListener("change", function () {
      const selectedCategory = categorySelect.value.toLowerCase();

      // Filtrar cursos com base na categoria
      const courses = document.querySelectorAll(".course");
      courses.forEach(course => {
        const category = course.getAttribute("data-category").toLowerCase();
        if (selectedCategory === "" || category.includes(selectedCategory)) {
          course.style.display = "block";
        } else {
          course.style.display = "none";
        }
      });
    });

    // Busca de curso por nome
    const searchInput = document.getElementById("search");

    searchInput.addEventListener("input", function () {
      const searchTerm = searchInput.value.toLowerCase();
      const courses = document.querySelectorAll(".course");

      courses.forEach(course => {
        const courseName = course.querySelector("h3").textContent.toLowerCase();
        if (courseName.includes(searchTerm)) {
          course.style.display = "block";
        } else {
          course.style.display = "none";
        }
      });
    });