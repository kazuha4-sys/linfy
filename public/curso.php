<?php 
// Proteção contra acesso direto 
if(basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die('DEDSEC_SYSTEM_SECURITY: Acess denied!');
}

// Inclui o sistema de segurança de url e a conexão com o dataset 
require 'routes/route.php'; // Contem as funções de segurança
require 'db.php';           // Contem as funções para conexao com o dataset 

// Lista de URLs permitidas - define quem pode ir para onde
$urls_permitidas = [
    'cursos' => 'http://localhost/linfy/public/curso.php',                                    // Pagina oublica de cursos(ESSA
    'login' => 'http://localhost/linfy/auth/login/login.php', // Pagina de login
// NÂO COLOCAR 'admin' AQUI SE QUISER BLOQUEAR
]; 

// Verificar se está tentando acessar uma rota indesejada via (GET 'destino'])

if (isset($_GET['destino'])) {
    $destino = $_GET['destino'];
    if (!urlValida($destino, $urls_permitidas)) {
        http_response_code(403);
        die ("DEDESC_SYSTEM_SECURITY: ACESS DENIED `$destino`!");
    } else {
        // Redirecionar se for valida
        header("Location: " . $urls_permitidas[$destino]);
        exit();
    }    
}

$sql = "SELECT id, nome, preco, link, mini_descricao, descricao, categoria, imagem FROM cursos ORDER BY nome ASC";
$result = $conn->query($sql);

// Verificar se a consilta deu bom 
if (!$result) {
    die("Erro ao executar consulta: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='Kauan Cybis/Kazuha4-sys' content="width=device-width, initial-scale=1.0">
    <title>Comprar Cursos - Linfy</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <meta name="description" content="Linfy - Os melhores cursos online para impulsionar sua carreira!">
    <meta property="og:title" content="Linfy - Cursos Online">
    <meta property="og:amor" content="maite, vai tomar no seu cu sua puta de uma gstz">
    <meta property="og:description" content="Descubra os melhores cursos online com Linfy e eleve seu conhecimento.">
    <meta property="og:image" content="link-da-imagem.jpg"> <!-- Coloque aqui o link da imagem principal do site -->
  <style>
/* Reset básico e configurações de box-sizing */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
}

/* Corpo da página */
body {
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #f5f7fa;
  color: #333;
  font-size: 16px;
}

/* Cabeçalho */
header {
  width: 100%;
  background-color: #ffffff;
  color: #333;
  padding: 30px 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
  position: relative;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

header h1 {
  margin-bottom: 10px;
  font-size: 32px;
  color: #4a90e2;
  font-weight: 600;
}

.add-course-button {
  position: absolute;
  top: 20px;
  left: 20px;
  padding: 12px 20px;
  border-radius: 5px;
  background-color: #4a90e2;
  color: white;
  font-size: 16px;
  border: none;
  cursor: pointer;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s;
}

.add-course-button:hover {
  background-color: #357ab7;
}

/* Filtros de pesquisa */
.filters {
  display: flex;
  align-items: center;
  gap: 15px;
  width: 100%;
  max-width: 900px;
  justify-content: space-between;
  margin-top: 20px;
}

.filters input[type="text"] {
  width: 45%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
  transition: border-color 0.3s;
}

.filters input[type="text"]:focus {
  border-color: #4a90e2;
}

.category-filter select,
.price-filter input {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  background-color: white;
  font-size: 14px;
  color: #4a90e2;
  transition: border-color 0.3s;
}

.category-filter select:focus,
.price-filter input:focus {
  border-color: #4a90e2;
}

/* Preço Filtro */
.price-filter {
  display: flex;
  align-items: center;
  gap: 10px;
}

#priceDisplay {
  font-weight: bold;
  color: #4a90e2;
}

/* Cursos */
main {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  width: 100%;
  max-width: 1200px;
}

#courses {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  width: 100%;
}

/* Estilo dos cursos */
.course {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  width: 250px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  cursor: pointer;
  opacity: 1;
  transform: translateY(0);
}

.course:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.course h3 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #333;
}

.course p {
  font-size: 16px;
  color: #666;
  margin-bottom: 10px;
}

.course button {
  padding: 10px 15px;
  background-color: #4a90e2;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.course button:hover {
  background-color: #357ab7;
}

/* Imagem do curso */
.course-image img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 15px;
}

/* Responsividade */
@media (max-width: 768px) {
  .filters {
    flex-direction: column;
    align-items: flex-start;
  }

  .filters input[type="text"],
  .category-filter select {
    width: 100%;
    margin-bottom: 10px;
  }

  #courses {
    flex-direction: column;
    align-items: center;
  }
}

  </style>
</head>
<body>
  <header>
    <h1>Cursos Online</h1>
    <div class="filters">
      <input type="text" id="search" placeholder="Buscar curso...">
      <div class="category-filter">
        <select id="categorySelect">
          <option value="">Todas as Categorias</option>
          <option value="Programação">Programação</option>
          <option value="Design">Design</option>
          <option value="Marketing">Marketing</option>
          <option value="Negócios">Negócios</option>
        </select>
      </div>
      <div class="price-filter">
        <label for="priceFilter">Preço:</label>
        <input type="range" id="priceFilter" min="0" max="500" step="50">
        <span id="priceDisplay">Até R$500</span>
      </div>
    </div>
  </header>
  <main>
    <section id="courses">
      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<div class="course" data-category="' . htmlspecialchars($row["categoria"]) . '" data-price="' . htmlspecialchars($row["preco"]) . '">';
              echo '<div class="course-image">
              <img src="' . $row["imagem"] . '" alt="' . htmlspecialchars($row["nome"]) . '">';
              echo '</div>';
              echo '<h3>' . htmlspecialchars($row["nome"]) . '</h3>';
              echo '<p>Preço: R$' . htmlspecialchars($row["preco"]) . '</p>';
              echo '<p>' . htmlspecialchars($row["mini_descricao"]) . '</p>';
              echo '<button onclick="location.href=\'' . $row["link"] . '\'">Ver Curso</button>';
              echo '</div>';
          }
      } else {
          echo '<p>Nenhum curso encontrado.</p>';
      }
      ?>
    </section>
  </main>

  <script src="../js/barra.js"></script>
</body>
</html>
