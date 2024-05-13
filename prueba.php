<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paginado en JavaScript</title>
  <style>
    .container {
      width: 80%;
      margin: 0 auto;
      text-align: center;
    }
    .pagination {
      margin-top: 20px;
    }
    .pagination button {
      margin: 0 5px;
      padding: 5px 10px;
      cursor: pointer;
    }
    .active {
      background-color: #ccc;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="content"></div>
    <div class="pagination"></div>
  </div>

  <script>
    // Datos de ejemplo (aquí deberías obtener los datos de tu API)
    const data = Array.from({ length: 50 }, (_, index) => index + 1);

    // Configuración del paginado
    const itemsPerPage = 10;
    let currentPage = 1;

    // Función para mostrar los elementos de la página actual
    function displayItems(page) {
      const content = document.querySelector('.content');
      content.innerHTML = '';

      const startIndex = (page - 1) * itemsPerPage;
      const endIndex = page * itemsPerPage;

      const items = data.slice(startIndex, endIndex);
      items.forEach(item => {
        const div = document.createElement('div');
        div.textContent = `Item ${item}`;
        content.appendChild(div);
      });
    }

    // Función para generar los botones de paginación
    function renderPagination() {
      const pagination = document.querySelector('.pagination');
      pagination.innerHTML = '';

      const totalPages = Math.ceil(data.length / itemsPerPage);
      for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement('button');
        button.textContent = i;
        if (i === currentPage) {
          button.classList.add('active');
        }
        button.addEventListener('click', () => {
          currentPage = i;
          displayItems(currentPage);
          renderPagination();
        });
        pagination.appendChild(button);
      }
    }

    // Mostrar la página inicial
    displayItems(currentPage);
    renderPagination();
  </script>
</body>
</html>
