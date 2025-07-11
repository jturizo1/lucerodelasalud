<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>LUCEROS DE LA SALUD</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/favicon.svg">

   <!-- CSS here -->
    <!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <link rel="stylesheet" href="assets/css/responsive.css">
   <link rel="stylesheet" href="assets/css/estilo.css">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/meanmenu.min.css">
   <link rel="stylesheet" href="assets/css/animate.css">
   <link rel="stylesheet" href="assets/css/swiper.min.css">
   <link rel="stylesheet" href="assets/css/slick.css">
   <link rel="stylesheet" href="assets/css/magnific-popup.css">
   <link rel="stylesheet" href="assets/css/fontawesome-pro.css">
   <link rel="stylesheet" href="assets/css/spacing.css">
   <link rel="stylesheet" href="assets/css/main.css">
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9GLLP82379"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-9GLLP82379');
</script>
<style>

</style>

<body>

   <!-- preloader start -->
   <div id="preloader">
      <div class="bd-loader-inner">
         <div class="bd-loader">
            <span class="bd-loader-item"></span>
            <span class="bd-loader-item"></span>
            <span class="bd-loader-item"></span>
            <span class="bd-loader-item"></span>
            <span class="bd-loader-item"></span>
            <span class="bd-loader-item"></span>
            <span class="bd-loader-item"></span>
            <span class="bd-loader-item"></span>
         </div>
      </div>
   </div>
   <!-- preloader start -->

   <!-- Back to top start -->


   <a href="https://wa.me/573001234567" class="whatsapp" id="btnWhatsapp" target="_blank" aria-label="WhatsApp">
      <i class="fab fa-whatsapp"></i>
   </a>    
  
   <script>
       const btnWhatsapp = document.getElementById('btnWhatsapp');

      window.addEventListener('scroll', () => {
         if (window.scrollY > 300) {
            btnWhatsapp.classList.add('active-progress');
         } else {
            btnWhatsapp.classList.remove('active-progress');
         }
      });
   </script>

   <div style="position: fixed;" class="backtotop-wrap cursor-pointer">
      <svg class="backtotop-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
         <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
   </div>



   <!-- Back to top end -->

   <!-- search area start 
   <div class="df-search-area">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="df-search-form">
                  <div class="df-search-close text-center mb-20">
                     <button class="df-search-close-btn df-search-close-btn"></button>
                  </div>
                  <form action="#">
                     <div class="df-search-input mb-10">
                        <input type="text" placeholder="Que deseas buscar...">
                        <button type="submit"><i class="flaticon-search-1"></i></button>
                     </div>
                     <div class="df-search-category">
                        <span>Sugerencias de Búsqueda : </span>
                        <a href="#">Healthline, </a>
                        <a href="#">COVID-19, </a>
                        <a href="#">Surgery, </a>
                        <a href="#">Surgeon, </a>
                        <a href="#">Medical research</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="body-overlay"></div>
   search area end -->

   <!-- Offcanvas area start -->
   <div class="fix">
      <div class="offcanvas__info">
         <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
               <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                  <!--
                  <div class="offcanvas__logo">
                     <a href="#">
                        <img src="assets/imgs/logo/logo-white.svg" alt="logo not found">
                     </a>
                  </div>-->
                  <div class="offcanvas__close">
                     <button>
                        <i class="fal fa-times"></i>
                     </button>
                  </div>
               </div>
               <div class="offcanvas__search mb-25">
                  <form id="searchForm" action="#">
                     <input type="text" id="searchInput" placeholder="¿Qué estás buscando?">
                     <button type="submit"><i class="far fa-search"></i> Buscar</button>
                  </form>
               </div>  
               <div class="mobile-menu fix mb-40"></div>
               <div class="offcanvas__contact mt-30 mb-20">
                  <h4>Información de Contacto</h4>
                  <ul>
                     <li class="d-flex align-items-center">
                        <div class="offcanvas__contact-icon mr-15">
                           <i class="far fa-phone"></i>
                        </div>
                        <div class="offcanvas__contact-text">
                           <a href="https://wa.link/1mnyiv" target="_blank">+57 305 789 7369</a>
                        </div>
                     </li>
                     <li class="d-flex align-items-center">
                        <div class="offcanvas__contact-icon mr-15">
                           <i class="fal fa-envelope"></i>
                        </div>
                        <div class="offcanvas__contact-text">
                           <a href="#"><span class="">lucerosdelasalud25@gmail.com</span></a>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="offcanvas__social">
                  <ul>
                     <li><a target="_blank" href="https://www.facebook.com/profile.php?id=61567320609061"><i class="fab fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                     <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                     <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="offcanvas__overlay"></div>
   <div class="offcanvas__overlay-white"></div>
   <!-- Offcanvas area start -->

   <script>
  
</script>

   <!-- Header area start -->
    <header>
      <?php include 'assets/includes/header.php';   ?>
    </header>
    
   <!-- Header area end -->

   <!-- Body main wrapper start -->
   <main>
      <section>
            <video autoplay="" muted="" loop=""  width="100%" height="auto">
                  <source src="assets/videos/Background.mp4" type="video/mp4">
                  <source src="assets/videos/Background.mp4" type="video/webm">
                  Tu navegador no soporta la etiqueta de video HTML5.
            </video>
      </section>
   </main>
   <!-- Body main wrapper end -->

   <!-- About area start -->
    <section style="padding-top:20px; padding-bottom:20px;" id="nosotros">
      <div class="container">
         <div class="row">
            <div class="col-6">
               <div class="about-thumb w-img">
                     <video autoplay="" muted="" loop="" controls width="100%" height="700px">
                        <source src="assets/videos/Nosotros.mp4" type="video/mp4">
                        <source src="assets/videos/Nosotros.mp4" type="video/webm">
                        Tu navegador no soporta la etiqueta de video HTML5.
                    </video>
               </div>
            </div>
            <div class="col-6">
               <div class="about-content-box-2 wow  fadeInRight animated" data-wow-delay="0.3s">
                  <div class="section-title-wrapper-2 mb-15">
                     <span class="section-subtitle-2 mb-25">Acerca de Nosotros</span>
                     <h2 class="section-title">Luceros <BR>de la Salud</h2>
                  </div>
                  <p class="item-busqueda" style="text-align: justify;">Nos dedicamos a ofrecer servicios de enfermería especializados y humanizados, enfocados en la atención domiciliaria personalizada. 
                     Nuestro equipo de profesionales actúa con ética, vocación y compromiso, brindando cuidados integrales que promueven el bienestar y la recuperación 
                     de nuestros pacientes. Nos proyectamos como líderes a nivel nacional en atención de calidad, con una fuerte orientación a la mejora continua, 
                     la innovación y el desarrollo profesional, siendo un referente en el cuidado de la salud con calidez y excelencia.</p>
                  
                    <div class="button-wrapper mt-45">
                        <a href="#" class="fill-btn secondary">
                            <span class="fill-btn-inner">
                            <span class="fill-btn-normal">Ver Mas ...<i class="fa-regular fa-angle-right"></i></span>
                            <span class="fill-btn-hover">Ver Mas ...<i class="fa-regular fa-angle-right"></i></span>
                            </span>
                        </a>
                     <div class="link-text">
                        <span><img src="assets/imgs/svg/phone-call.svg" alt=""></span>
                        <a href="https://wa.link/1mnyiv" target="_blank">+57 305 789 7369</a>
                     </div>
                  </div>
            </div>
         </div>
      </div>
    </section>

    <section style="background-color:#0C7FF0; padding-top:20px; padding-bottom:20px;" id="servicios">
      <div class="container">
         <div class="row">
            <h1 style="color:white !important; ">Nuestros Servicios</h1>
         </div>
         <div class="row">
            <div class="col-6">
               <p style="text-align: justify; color: white;" class="mb-0">En Luceros de la Salud ofrecemos una amplia gama de servicios de enfermería domiciliaria, diseñados para brindar atención 
                        personalizada, ética y de alta calidad en el entorno más cómodo para el paciente: su hogar. Nuestro equipo de profesionales está capacitado
                        para atender necesidades de promoción, mantenimiento y recuperación de la salud, con un enfoque integral y humano. Desde cuidados postoperatorios,
                        control de signos vitales y administración de medicamentos, hasta acompañamiento en procesos crónicos o paliativos, garantizamos un servicio 
                        comprometido con el bienestar, la dignidad y la tranquilidad de cada persona y su familia.
               </p>  
            </div>
            <div class="col-6">
               <center>
                  <img style="border-radius:5px" width="490px" height="280" src="https://garcialawfirmtj.com/wp-content/uploads/2019/05/Screen-Shot-2019-05-15-at-7.29.19-PM-1.png" alt="imagen">
               </center>
            </div>
         </div>
      </div><!-- fin div container-->
      <div style="padding-top:30px !important;" class="contanier-full">
            <div class="service-grid wow fadeInUp" data-wow-delay="0.3s">
               <div class="service-item-2">
                  <div class="service-icon-2 mb-25">
                     <span>
                        <img src="assets/imgs/service/icon/1/service-1.png" alt="">
                        <img src="assets/imgs/service/icon/1/service-2-1.png" alt="">
                     </span>
                  </div>
                  <h5 class="service-title-2"><a href="#">HOSPITALIZACIÓN</a></h5>
                  <div class="service-bottom-content">
                     <p style="text-align: justify;">Brindamos atención especializada en el hogar para pacientes que requieren cuidados hospitalarios sin necesidad de permanecer en una clínica. 
                        Nuestro servicio de hospitalización domiciliaria incluye monitoreo constante, administración de tratamientos, control de signos vitales y 
                        seguimiento médico, todo en un entorno familiar y seguro, promoviendo una recuperación más cómoda y humanizada.
                     </p>
                  </div>
               </div>
               <div class="service-item-2">
                  <div class="service-icon-2 mb-25">
                     <span>
                        <img src="assets/imgs/service/icon/1/service-2.png" alt="">
                        <img src="assets/imgs/service/icon/1/service-2-2.png" alt="">
                     </span>
                  </div>
                  <h5 class="service-title-2"><a href="#">TRÁMITES ANTE EPS</a></h5>
                  <div class="service-bottom-content">
                     <p style="text-align: justify;">En Luceros de la Salud acompañamos a nuestros pacientes y sus familias en la gestión de trámites ante las EPS, facilitando autorizaciones, 
                        renovación de servicios y seguimiento de procesos administrativos. Nuestro equipo está capacitado para brindar orientación clara y oportuna, 
                        aliviando la carga burocrática y asegurando el acceso oportuno a los servicios de salud requeridos.
                     </p>
                  </div>
               </div>
               <div class="service-item-2">
                  <div class="service-icon-2 mb-25">
                     <span>
                        <img src="assets/imgs/service/icon/1/service-3.png" alt="">
                        <img src="assets/imgs/service/icon/1/service-2-3.png" alt="">
                     </span>
                  </div>
                  <h5 class="service-title-2"><a href="#">ADMINISTRACIÓN DE MEDICAMENTOS</a></h5>
                  <div class="service-bottom-content">
                     <p style="text-align: justify;">Ofrecemos un servicio seguro y profesional de administración de medicamentos en el hogar, garantizando el cumplimiento de tratamientos médicos 
                        con precisión y responsabilidad. Nuestro personal de enfermería se encarga de aplicar medicamentos por vía oral, intravenosa, intramuscular y subcutánea, 
                        asegurando la correcta dosificación, horarios y registro, con el fin de proteger la salud y bienestar del paciente.
                     </p>
                  </div>
               </div>
               <div class="service-item-2">
                  <div class="service-icon-2 mb-25">
                     <span>
                        <img src="assets/imgs/service/icon/1/service-4.png" alt="">
                        <img src="assets/imgs/service/icon/1/service-2-4.png" alt="">
                     </span>
                  </div>
                  <h5 class="service-title-2"><a href="#">ACOMPAÑAMIENTOS</a></h5>
                  <div class="service-bottom-content">
                     <p style="text-align: justify;">Brindamos orientación y formación a familiares de pacientes con Alzheimer, demencias y esquizofrenia, con el objetivo de fortalecer sus habilidades 
                        para el cuidado diario. A través de sesiones prácticas y asesoría especializada, enseñamos estrategias para el manejo de síntomas, comunicación efectiva 
                        y contención emocional, promoviendo un entorno más seguro, comprensivo y digno tanto para el paciente como para su núcleo familiar.
                     </p>
                  </div>
               </div>
               <div class="service-item-2">
                  <div class="service-icon-2 mb-25">
                     <span>
                        <img src="assets/imgs/service/icon/1/service-5.png" alt="">
                        <img src="assets/imgs/service/icon/1/service-2-5.png" alt="">
                     </span>
                  </div>
                  <h5 class="service-title-2"><a href="#">TRAMITES DE MEDICAMENTOS</a></h5>
                  <div class="service-bottom-content">
                     <p style="text-align: justify;">En Luceros de la Salud facilitamos la recogida de medicamentos en farmacias y entidades de salud, garantizando que nuestros pacientes reciban sus tratamientos
                        de manera oportuna y segura. Este servicio está pensado para apoyar a quienes enfrentan barreras de movilidad o tiempo, asegurando continuidad en el tratamiento
                        sin complicaciones ni demoras.
                     </p>
                  </div>
               </div>
            </div>
         </div> <!-- fin div container-full-->
   </section>
   
    <section class="benefit-area section-space" id="mision">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 style="text-align: center"> Misión</h2><br>
                    <p style="text-align: justify;">
                        En Luceros de la Salud brindamos servicios de enfermería especializados y humanizados, con un enfoque integral en la promoción, 
                        mantenimiento y recuperación de la salud. Nos especializamos en atención domiciliaria, ofreciendo cuidados personalizados y de 
                        alta calidad en el entorno del paciente. Nuestro equipo de profesionales actúa con ética, vocación y compromiso, contribuyendo 
                        al bienestar individual y al fortalecimiento del sistema de salud con estándares de excelencia.
                    </p>
                </div>
                <div class="col-md-6">
                    <h2 style="text-align: center">Visión</h2><br>
                    <p style="text-align: justify;">
                        Luceros de la Salud se posicionará como una empresa líder en servicios de enfermería domiciliaria a nivel nacional, destacando 
                        por su excelencia en la atención, calidad humana e innovación en el cuidado de la salud. Nos proyectamos como un referente en 
                        atención integral, comprometidos con la mejora continua y el desarrollo profesional de nuestro equipo, para contribuir al bienestar 
                        y dignidad de nuestros pacientes.
                    </p>
                </div>
            </div>
        </div>
    </section>
   <!-- Testimonial area start 
   <section  class="testimonial-area section-space p-relative">
      <div class="testimonial-bg">
         <div class="testimonial-bg-thumb include-bg" data-background="assets/imgs/bg/testimonial-bg.png"></div>
      </div>
      <div class="container">
         <div class="row gy-50 align-items-center">
            <div class="col-xxl-7 col-xl-7 col-lg-6">
               <div class="swiper testimonial-active-2">
                  <div class="swiper-wrapper">
                     <div class="swiper-slide">
                        <div class="testimonial-content-2">
                           <div class="testimonial-icon">
                              <img src="assets/imgs/icons/quote-white.png" alt="">
                           </div>
                           <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in
                              hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur,
                              ultrices mauris. Maecenas.</p>
                           <div class="testmonial-bottom">
                              
                              <div class="common-slider-navigation is-white">
                                 <button class="testimonial-button-prev"><i
                                       class="fa-regular fa-arrow-left"></i></button>
                                 <button class="testimonial-button-next"><i
                                       class="fa-regular fa-arrow-right"></i></button>
                              </div>
                              <div class="avatar-item">
                                 <div class="avatar-info-2">
                                    <h4 class="avatar-name"><a href="#">Alexsia Jorgina</a></h4>
                                    <span>Director</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="testimonial-content-2">
                           <div class="testimonial-icon">
                              <img src="assets/imgs/icons/quote-white.png" alt="">
                           </div>
                           <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in
                              hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur,
                              ultrices mauris. Maecenas.</p>
                           <div class="testmonial-bottom">
                              
                              <div class="common-slider-navigation is-white">
                                 <button class="testimonial-button-prev"><i
                                       class="fa-regular fa-arrow-left"></i></button>
                                 <button class="testimonial-button-next"><i
                                       class="fa-regular fa-arrow-right"></i></button>
                              </div>
                              <div class="avatar-item">
                                 <div class="avatar-info-2">
                                    <h4 class="avatar-name"><a href="#">Alexsia Jorgina</a></h4>
                                    <span>Director</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="testimonial-content-2">
                           <div class="testimonial-icon">
                              <img src="assets/imgs/icons/quote-white.png" alt="">
                           </div>
                           <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in
                              hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur,
                              ultrices mauris. Maecenas.</p>
                           <div class="testmonial-bottom">
                             
                              <div class="common-slider-navigation is-white">
                                 <button class="testimonial-button-prev"><i
                                       class="fa-regular fa-arrow-left"></i></button>
                                 <button class="testimonial-button-next"><i
                                       class="fa-regular fa-arrow-right"></i></button>
                              </div>
                              <div class="avatar-item">
                                 <div class="avatar-info-2">
                                    <h4 class="avatar-name"><a href="#">Alexsia Jorgina</a></h4>
                                    <span>Director</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xxl-5 col-xl-5 col-lg-6">
               <div class="testimonial-thumb-wrapper d-md-flex justify-content-lg-end">
                  <div class="testimonial-thumb">
                     <img src="assets/imgs/testimonial/testimoial-thumb-01.jpg" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   Testimonial area end -->

   <!-- Team area start -->
   <section class="team-area border-up section-space" id="equipo">
      <div class="container">
         <div class="row gy-5">
            <div class="col-xxl-4 col-xl-4 col-lg-4">
               <div class="section-title-wrapper">
                  <div class="section-subtitle">
                     <span>Nuestro Equipo</span>
                  </div>
                  <h2 class="section-title mb-25">Conoce a Nuestro Equipo de Expertos</h2>
                  <p class="mb-35">Contamos con personal altamente capacitado.</p>
                  <!--<a href="#" class="fill-btn">
                      <span class="fill-btn-inner">
                        <span class="fill-btn-normal">Ver Mas ...<i class="fa-regular fa-angle-right"></i></span>
                        <span class="fill-btn-hover">Ver Mas ...<i class="fa-regular fa-angle-right"></i></span>
                     </span>
                  </a>-->
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4">
               <div class="team-item text-center">
                  <div class="team-thumb fix">
                     <a href="#">
                        <img src="assets/imgs/team/team-01.jpg" alt="imagen">
                     </a>
                  </div>
                  <div class="team-content">
                     <h3 class="team-title"><a href="#">Maria Angélica Garzón Martínez</a></h3>
                     <p>Auxiliar de enfermería.</p>
                     <button onclick="perfil1()">Ver mas...</button>



                    <!-- <div class="team-social d-flex justify-content-center gap-3">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                     </div> -->
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4">
               <div class="team-item text-center">
                  <div class="team-thumb fix">
                     <a href="#">
                        <img src="assets/imgs/team/team-02.jpg" alt="">
                     </a>
                  </div>
                  <div class="team-content">
                     <h3 class="team-title"><a href="#">Juan Sebastián Pineda Garzón  </a></h3>
                     <p>Jefe de enfermería.</p>
                     <button onclick="perfil2()">Ver mas...</button>
                     <!--
                     <div class="team-social d-flex justify-content-center gap-3">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                     </div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section style="padding-bottom:20px;" class="" id="capacitaciones">
      <div class="container">
         <div class="row ">
            <div class="section-title-wrapper">
               <div style="padding-top:30px" class="section-subtitle">
                  <span>Capacitaciones</span>
               </div>
            </div>   
         </div>
         <div class="row">
             <video autoplay="" muted="" loop=""  width="100%" height="auto">
               <source src="assets/videos/Capacitaciones.mp4" type="video/mp4">
               <source src="assets/videos/Capacitaciones.mp4" type="video/webm">
               Tu navegador no soporta la etiqueta de video HTML5.
         </video>
         </div>
      </div>
   </section>
   <!-- Team area end -->
   <!-- Footer area start -->
   <footer>
      <?php include 'assets/includes/footer.php'; ?>
   </footer>
   <!-- Footer area end -->

   <!-- JS here -->
   <script src="assets/js/jquery-3.6.0.min.js"></script>
   <script src="assets/js/waypoints.min.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/meanmenu.min.js"></script>
   <script src="assets/js/swiper.min.js"></script>
   <script src="assets/js/slick.min.js"></script>
   <script src="assets/js/magnific-popup.min.js"></script>
   <script src="assets/js/counterup.js"></script>
   <script src="assets/js/wow.js"></script>
   <script src="assets/js/ajax-form.js"></script>
   <script src="assets/js/beforeafter.jquery-1.0.0.min.js"></script>
   <script src="assets/js/main.js"></script>
   <script src="assets/js/eventos.js"></script>
</body>

</html>