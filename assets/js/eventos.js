function perfil1() {
    Swal.fire({
      
      imageUrl: "assets/imgs/team/team-01.jpg",
      title: "Maria Angélica Garzón Martínez",
      html: `
      <p class="swal2-justify">
        Profesional con sólida experiencia en el manejo de pacientes con enfermedades neurodegenerativas como Alzheimer, demencias combinadas, demencia frontotemporal y esquizofrenia. 
      </p>,
      <p class="swal2-justify">
        Encargada de capacitar y guiar al equipo de auxiliares de enfermería dentro de la empresa, promoviendo buenas prácticas asistenciales. Asimismo, realiza orientación y formación a familiares, brindándoles herramientas para el cuidado adecuado de pacientes con deterioro cognitivo y trastornos psiquiátricos.
      </p>
    `,
      showCloseButton: true,
      imageHeight: 250,
      imageWidth:250,
      showConfirmButton: false,
      imageAlt: "A tall image"
    });
  }

  function perfil2() {
    Swal.fire({
      
      imageUrl: "assets/imgs/team/team-02.jpg",
      title: "Juan Sebastián Pineda Garzón",
      html: `
      <p class="swal2-justify">
        Jefe de enfermería encargado de revisión de hojas de vida de las auxiliares cursos vigentes y verificación en rethus.  
      </p>,
      <p class="swal2-justify">
       Verificación de notas de enfermería, escalas, revisión cefalocaudal de los pacientes a cargo de la empresa.
      </p>
    `,
      showCloseButton: true,
      imageHeight: 250,
      imageWidth:250,
      showConfirmButton: false,
      imageAlt: "A tall image"
    });
  } 
  
  // Eventos de Barra de Busqueda 

document.getElementById("searchForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const query = document.getElementById("searchInput").value.toLowerCase();

  const secciones = [
    { id: "nosotros", nombre: "nosotros", keywords: ["nosotros", "enfermería", "pacientes"] },
    { id: "servicios", nombre: "servicios", keywords: ["hospitalizacion", "tramites", "medicamentos", "acompañamientos"] },
    { id: "equipo", nombre: "equipo", keywords: ["enfermera", "personal", "auxiliar", "expertos"] }
  ];

  const match = secciones.find(seccion =>
    seccion.keywords.some(palabra => query.includes(palabra))
  );

  if (match) {
    const target = document.getElementById(match.id);

    Swal.fire({
      position: "top-end",
      icon: "success",
      title: `Sección encontrada: ${match.nombre}`,
      showConfirmButton: false,
      timer: 1200
    }).then(() => {
      // Cerrar el offcanvas
      const closeButton = document.querySelector(".offcanvas__close button");
      if (closeButton) closeButton.click();

      // Esperar 400ms antes de hacer scroll (ajusta según tu animación CSS)
      setTimeout(() => {
        if (target) {
          target.scrollIntoView({ behavior: "smooth", block: "start" });

          // Resaltar la sección
          target.classList.add("seccion-resaltada");
          setTimeout(() => {
            target.classList.remove("seccion-resaltada");
          }, 2000);
        }
      }, 400); // Ajusta este valor si tu offcanvas tarda más o menos en cerrarse
    });

  } else {
    Swal.fire({
      position: "top-end",
      icon: "error",
      title: "No se encontró una sección relacionada.",
      showConfirmButton: false,
      timer: 1200
    });
  }
});