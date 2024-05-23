<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/img_index.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../estilo.css">
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f0f0f0;
}


main {
    flex: 1;
    padding: 2rem;
}

.about-us, .testimonials {
    max-width: 1400px;
    margin: 2rem auto;
    background-color: white;
    padding: 2rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.about-us:hover, .testimonials:hover {
    transform: translateY(-10px);
}

.about-us h2, .about-us h3, .testimonials h2 {
    color: #333;
    border-left: 4px solid #4CAF50;
    padding-left: 8px;
    margin-bottom: 1rem;
}

.about-us ul {
    list-style-type: disc;
    padding-left: 20px;
    margin: 1rem 0;
}

.testimonials blockquote {
    background-color: #f0f0f0;
    border-left: 5px solid #4CAF50;
    margin: 1rem 0;
    padding: 1rem;
    font-style: italic;
    position: relative;
    transition: background-color 0.3s ease;
}

.testimonials blockquote:hover {
    background-color: #e0e0e0;
}

.testimonials blockquote:before {
    content: "“";
    font-size: 4rem;
    color: #4CAF50;
    position: absolute;
    top: -20px;
    left: -20px;
}

@media (max-width: 600px) {
    body {
        padding: 1rem;
    }

    .about-us, .testimonials {
        padding: 1rem;
    }
}


    </style>
</head>
<body>
<?php   include "../components/navbar.php" ?>
    <main>
        <section class="about-us">
            <h2>Nuestra Historia</h2>
            <p>Somos una empresa dedicada a ofrecer soluciones innovadoras en tecnología. Desde nuestros inicios, hemos trabajado arduamente para ganar la confianza de nuestros clientes y mejorar continuamente nuestros servicios.</p>
            <h2>Nuestro Equipo</h2>
            <p>Contamos con un equipo de profesionales altamente capacitados y comprometidos con la excelencia. Cada miembro de nuestro equipo aporta su experiencia y habilidades para garantizar los mejores resultados.</p>
            <h2>Nuestra Misión</h2>
            <p>Nuestra misión es proporcionar productos y servicios de alta calidad que superen las expectativas de nuestros clientes. Nos esforzamos por ser líderes en nuestro sector, manteniéndonos a la vanguardia de las últimas tecnologías.</p>
            <h2>Información Adicional</h2>
            <p>Además de nuestros servicios principales, ofrecemos consultoría especializada para ayudar a las empresas a optimizar sus procesos y adoptar las últimas tendencias tecnológicas. También organizamos talleres y seminarios para fomentar el desarrollo profesional continuo de nuestro equipo y de nuestros clientes.</p>
            <h3>Proyectos Recientes</h3>
            <ul>
                <li>Implementación de sistemas de inteligencia artificial en el sector salud.</li>
                <li>Desarrollo de plataformas de comercio electrónico personalizadas.</li>
                <li>Consultoría en ciberseguridad para grandes corporaciones.</li>
                <li>Desarrollo de aplicaciones móviles para mejorar la experiencia del usuario.</li>
                <li>Implementación de soluciones de big data para análisis de mercado.</li>
            </ul>
            <h3>Nuestros Valores</h3>
            <p>Nos regimos por valores como la integridad, la innovación y la excelencia. Creemos que estos principios son fundamentales para construir relaciones duraderas y exitosas con nuestros clientes.</p>
            <h3>Nuestros Servicios</h3>
            <p>Ofrecemos una amplia gama de servicios para satisfacer las diversas necesidades de nuestros clientes, incluyendo:</p>
            <ul>
                <li>Desarrollo de software a medida</li>
                <li>Integración de sistemas</li>
                <li>Consultoría en transformación digital</li>
                <li>Soporte técnico y mantenimiento</li>
                <li>Capacitación y formación en nuevas tecnologías</li>
            </ul>
        </section>
        <section class="testimonials">
            <h2>Testimonios</h2>
            <p>Lo que nuestros clientes dicen sobre nosotros:</p>
            <blockquote>
                "El equipo de esta empresa ha sido fundamental para el éxito de nuestro proyecto. Su profesionalismo y dedicación son incomparables." - Juan Pérez, CEO de Tech Solutions
            </blockquote>
            <blockquote>
                "Gracias a sus innovadoras soluciones, hemos podido mejorar significativamente nuestra eficiencia operativa." - María López, Directora de Operaciones de Innovatech
            </blockquote>
            <blockquote>
                "La consultoría en ciberseguridad que recibimos fue excepcional. Ahora estamos mejor preparados para enfrentar cualquier amenaza." - Carlos Gómez, Gerente de TI de Secure Corp
            </blockquote>
        </section>
    </main>


    <?php   include "../components/footer.php" ?>


    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</body>
</html>