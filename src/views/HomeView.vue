<script setup>
</script>

<template>
  <div id="app">
    <!-- Header/Navbar -->
    <header class="sticky top-0 z-50 transition-colors bg-white bg-opacity-90 backdrop-filter backdrop-blur-lg shadow-md">
      <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
          <a href="#" class="font-bold text-2xl text-indigo-600">
            <span class="text-indigo-800">PHP</span>este
          </a>
          
          <div class="flex items-center space-x-4">
            <nav class="hidden md:flex space-x-6">
              <a href="#about" class="text-gray-700 hover:text-indigo-600 transition-colors">Sobre</a>
              <a href="#tickets" class="text-gray-700 hover:text-indigo-600 transition-colors">Ingressos</a>
              <a href="#speakers" class="text-gray-700 hover:text-indigo-600 transition-colors">Palestrantes</a>
              <a href="#sponsors" class="text-gray-700 hover:text-indigo-600 transition-colors">Patrocinadores</a>
            </nav>
            
            <a href="#register" class="hidden md:block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition-colors font-medium">
              Inscreva-se
            </a>
            
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-md text-gray-700 hover:bg-gray-200 transition-colors">
              <i class="fas fa-bars"></i>
            </button>
          </div>
        </div>
        
        <!-- Mobile menu -->
        <div v-if="mobileMenuOpen" class="md:hidden mt-3 py-3 border-t border-gray-200">
          <nav class="flex flex-col space-y-3">
            <a href="#about" @click="mobileMenuOpen = false" class="text-gray-700 hover:text-indigo-600 transition-colors">Sobre</a>
            <a href="#tickets" @click="mobileMenuOpen = false" class="text-gray-700 hover:text-indigo-600 transition-colors">Ingressos</a>
            <a href="#speakers" @click="mobileMenuOpen = false" class="text-gray-700 hover:text-indigo-600 transition-colors">Palestrantes</a>
            <a href="#sponsors" @click="mobileMenuOpen = false" class="text-gray-700 hover:text-indigo-600 transition-colors">Patrocinadores</a>
            <a href="#register" @click="mobileMenuOpen = false" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition-colors font-medium text-center">
              Inscreva-se
            </a>
          </nav>
        </div>
      </div>
    </header>
    
    <!-- Hero Section -->
    <section class="gradient-bg text-white py-16 md:py-24">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">PHPeste 2025</h1>
            <h2 class="text-xl md:text-2xl font-semibold mb-6">O maior evento de PHP do Nordeste</h2>
            <div class="mb-8">
              <div class="flex items-start mb-3">
                <i class="fas fa-map-marker-alt mt-1 mr-3 text-indigo-300"></i>
                <p>UESPI - Av. Nossa Sra. de Fátima, s/n - Parnaíba/PI</p>
              </div>
              <div class="flex items-start">
                <i class="fas fa-calendar-alt mt-1 mr-3 text-indigo-300"></i>
                <p>Em breve</p>
              </div>
            </div>
            <a href="#register" class="inline-block bg-white text-indigo-700 font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-gray-100 transition-colors transform hover:scale-105 duration-200">
              👉 Inscreva-se agora
            </a>
          </div>
          
          <div class="md:w-1/2 flex justify-center" data-aos="fade-left">
            <div class="relative">
              <svg class="w-64 h-64 md:w-80 md:h-80 text-white opacity-10" viewBox="0 0 24 24" fill="currentColor">
                <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-3.339c-1.456-.741-3.369-1.454-5.593-1.585V0h-2.372v2.143c-3.283.319-5.404 2.154-5.404 5.08 0 2.637 2.085 4.247 5.429 5.393 2.509.853 3.315 1.587 3.315 2.487 0 .944-.761 1.5-2.031 1.5-1.681 0-4.793-.876-6.643-2.19l-.902 3.616c1.611.973 4.053 1.792 6.576 1.903V24h2.371v-4.032c3.352-.319 5.591-2.287 5.591-5.397-.001-2.499-1.742-4.132-5.862-5.421z"/>
              </svg>
              <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-4xl md:text-6xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-300">2025</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>
    
    <!-- About Section -->
    <section id="about" class="py-16 bg-white transition-colors">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Sobre o Evento</h2>
          <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
        </div>
        
        <div class="flex flex-col md:flex-row items-center">
          <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
            <p class="text-lg text-gray-700 mb-6">
              O <span class="font-semibold text-indigo-600">PHPeste</span> é o maior evento de PHP do Nordeste, reunindo desenvolvedores, empresas e entusiastas para compartilhar conhecimento, experiências e as mais recentes tendências no ecossistema PHP.
            </p>
            <p class="text-lg text-gray-700 mb-6">
              Em 2025, o evento chega a Parnaíba/PI com uma programação repleta de palestras técnicas, workshops práticos e oportunidades de networking. Nosso objetivo é fortalecer a comunidade PHP no Nordeste brasileiro e proporcionar um ambiente de aprendizado colaborativo.
            </p>
            <p class="text-lg text-gray-700">
              Não perca a oportunidade de participar deste evento único que combina conteúdo de qualidade, conexões valiosas e uma experiência inesquecível na bela cidade de Parnaíba.
            </p>
          </div>
          
          <div class="md:w-1/2 md:pl-12" data-aos="fade-left">
            <div class="bg-gray-100 rounded-lg p-6 shadow-md">
              <h3 class="text-xl font-bold text-gray-900 mb-4">Informações do Evento</h3>
              
              <div class="space-y-4">
                <div class="flex items-center">
                  <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                    <i class="fas fa-users text-indigo-600"></i>
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900">Capacidade Total</h4>
                    <p class="text-gray-700">400 pessoas (360 pagantes, 40 livres)</p>
                  </div>
                </div>
                
                <div class="flex items-center">
                  <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                    <i class="fas fa-ticket-alt text-indigo-600"></i>
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900">Preço Base</h4>
                    <p class="text-gray-700">R$ 80,00</p>
                  </div>
                </div>
                
                <div class="flex items-center">
                  <div class="">
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900"></h4>
                    <p class="text-gray-700"></p>
                  </div>
                </div>
                
                <div class="flex items-center mt-18">
                  <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                    <i class="fas fa-map-marked-alt text-indigo-600"></i>
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900">Local</h4>
                    <p class="text-gray-700">UESPI - Parnaíba/PI</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Tickets Section -->
    <section id="tickets" class="py-16 bg-gray-100 transition-colors">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Lotes de Ingressos</h2>
          <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
          <p class="text-lg text-gray-700 max-w-2xl mx-auto">
            Garanta sua vaga no PHPeste 2025 com preços especiais nos primeiros lotes.
          </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Lote Especial para Piauienses -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-indigo-600 text-white py-4 px-6">
              <h3 class="text-xl font-bold">Lote Especial (PI)</h3>
              <p class="text-indigo-200">15/04 até 15/05</p>
            </div>
            <div class="p-6">
              <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Meia-entrada</span>
                  <span class="font-bold text-gray-900">R$ 40,00</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Entrada Solidária</span>
                  <span class="font-bold text-gray-900">R$ 50,00</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Inteira</span>
                  <span class="font-bold text-gray-900">R$ 80,00</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-gray-700">Com Camisa</span>
                  <span class="font-bold text-gray-900">+R$ 30,00</span>
                </div>
              </div>
              <div class="pt-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                  <span class="font-medium text-gray-700">Vagas</span>
                  <span class="font-bold text-indigo-600">90 ingressos</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Primeiro Lote -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="200">
            <div class="bg-indigo-500 text-white py-4 px-6">
              <h3 class="text-xl font-bold">Primeiro Lote</h3>
              <p class="text-indigo-200">16/05 até 16/06</p>
            </div>
            <div class="p-6">
              <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Meia-entrada</span>
                  <span class="font-bold text-gray-900">R$ 50,00</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Entrada Solidária</span>
                  <span class="font-bold text-gray-900">R$ 60,00</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Inteira</span>
                  <span class="font-bold text-gray-900">R$ 100,00</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-gray-700">Com Camisa</span>
                  <span class="font-bold text-gray-900">+R$ 30,00</span>
                </div>
              </div>
              <div class="pt-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                  <span class="font-medium text-gray-700">Vagas</span>
                  <span class="font-bold text-indigo-600">90 ingressos</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Segundo Lote -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="300">
            <div class="bg-indigo-500 text-white py-4 px-6">
              <h3 class="text-xl font-bold">Segundo Lote</h3>
              <p class="text-indigo-200">17/06 até 31/08</p>
            </div>
            <div class="p-6">
              <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Meia-entrada</span>
                  <span class="font-bold text-gray-900">R$ 60,00</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Entrada Solidária</span>
                  <span class="font-bold text-gray-900">R$ 70,00</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Inteira</span>
                  <span class="font-bold text-gray-900">R$ 120,00</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-gray-700">Com Camisa</span>
                  <span class="font-bold text-gray-900">+R$ 35,00</span>
                </div>
              </div>
              <div class="pt-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                  <span class="font-medium text-gray-700">Vagas</span>
                  <span class="font-bold text-indigo-600">100 ingressos</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Terceiro Lote -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="400">
            <div class="bg-indigo-500 text-white py-4 px-6">
              <h3 class="text-xl font-bold">Terceiro Lote</h3>
              <p class="text-indigo-200">01/09 até 31/09</p>
            </div>
            <div class="p-6">
              <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Meia-entrada</span>
                  <span class="font-bold text-gray-900">R$ 70,00</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Entrada Solidária</span>
                  <span class="font-bold text-gray-900">R$ 80,00</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-700">Inteira</span>
                  <span class="font-bold text-gray-900">R$ 140,00</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-gray-700">Com Camisa</span>
                  <span class="font-bold text-gray-900">+R$ 40,00</span>
                </div>
              </div>
              <div class="pt-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                  <span class="font-medium text-gray-700">Vagas</span>
                  <span class="font-bold text-indigo-600">80 ingressos</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="text-center mt-10">
          <a href="#register" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-8 rounded-lg shadow-md transition-colors transform hover:scale-105 duration-200">
            👉 Garanta seu ingresso agora
          </a>
        </div>
      </div>
    </section>
    
    <!-- Speakers Section -->
    <section id="speakers" class="py-16 bg-white transition-colors">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Palestrantes</h2>
          <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
          <p class="text-lg text-gray-700 max-w-2xl mx-auto">
            Conheça os especialistas que compartilharão conhecimento no PHPeste 2025.
          </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Monica Craveiro -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="100">
            <div class="p-6">
              <div class="flex items-center justify-center mb-4">
                <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
                  <span class="text-3xl text-indigo-600">MC</span>
                </div>
              </div>
              <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Monica Craveiro</h3>
              <div class="flex justify-center">
                <span class="inline-block bg-green-100 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full">Confirmada</span>
              </div>
              <p class="text-center text-gray-600 mt-4">
                Especialista em PHP e Arquitetura de Software
              </p>
            </div>
          </div>
          
          <!-- Gustavo Web -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="200">
            <div class="p-6">
              <div class="flex items-center justify-center mb-4">
                <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
                  <span class="text-3xl text-indigo-600">GW</span>
                </div>
              </div>
              <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Gustavo Web</h3>
              <div class="flex justify-center">
                <span class="inline-block bg-green-100 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full">Confirmado</span>
              </div>
              <p class="text-center text-gray-600 mt-4">
                Especialista em PHP, Laravel e Microsserviços
              </p>
            </div>
          </div>
          
          <!-- Porã -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="300">
            <div class="p-6">
              <div class="flex items-center justify-center mb-4">
                <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
                  <span class="text-3xl text-indigo-600">P</span>
                </div>
              </div>
              <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Porã</h3>
              <div class="flex justify-center">
                <span class="inline-block bg-green-100 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full">Confirmado</span>
              </div>
              <p class="text-center text-gray-600 mt-4">
                Especialista em Segurança e PHP Moderno
              </p>
            </div>
          </div>
        </div>
        
        <!-- Coming Soon Speakers -->
        <div class="mt-12 bg-gray-100 rounded-lg p-8 text-center" data-aos="fade-up">
          <h3 class="text-xl font-bold text-gray-900 mb-4">Mais palestrantes em breve</h3>
          <p class="text-gray-700">
            Estamos confirmando mais especialistas para o PHPeste 2025. Fique atento às nossas redes sociais para novidades!
          </p>
        </div>
      </div>
    </section>
    
    <!-- Sponsors Section -->
    <section id="sponsors" class="py-16 bg-gray-100 transition-colors">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Patrocinadores e Apoio</h2>
          <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
          <p class="text-lg text-gray-700 max-w-2xl mx-auto">
            Conheça as empresas e instituições que tornam o PHPeste 2025 possível.
          </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Programe.io -->
          <div class="bg-white rounded-lg shadow-md p-8 flex items-center justify-center transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center">
              <div class="w-32 h-32 mx-auto bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                <span class="font-bold text-xl text-indigo-600">Programe.io</span>
              </div>
              <h3 class="font-bold text-gray-900">Patrocinador Diamante</h3>
            </div>
          </div>
          
          <!-- Alura -->
          <div class="bg-white rounded-lg shadow-md p-8 flex items-center justify-center transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center">
              <div class="w-32 h-32 mx-auto bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                <span class="font-bold text-xl text-indigo-600">Alura</span>
              </div>
              <h3 class="font-bold text-gray-900">Patrocinador Ouro</h3>
            </div>
          </div>
          
          <!-- UESPI -->
          <div class="bg-white rounded-lg shadow-md p-8 flex items-center justify-center transition-transform transform hover:scale-105 duration-300" data-aos="fade-up" data-aos-delay="300">
            <div class="text-center">
              <div class="w-32 h-32 mx-auto bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                <span class="font-bold text-xl text-indigo-600">UESPI</span>
              </div>
              <h3 class="font-bold text-gray-900">Apoio Institucional</h3>
            </div>
          </div>
        </div>
        
        <!-- Call for Sponsors -->
        <div class="mt-12 bg-indigo-100 rounded-lg p-8 text-center" data-aos="fade-up">
          <h3 class="text-xl font-bold text-indigo-800 mb-4">Seja um Patrocinador</h3>
          <p class="text-indigo-700 mb-6">
            Sua empresa quer fazer parte do maior evento de PHP do Nordeste? Entre em contato conosco e conheça nossos planos de patrocínio.
          </p>
          <a href="#contact" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg shadow-md transition-colors">
            Quero ser patrocinador
          </a>
        </div>
      </div>
    </section>
    
    <!-- Registration Section -->
    <section id="register" class="py-16 bg-white transition-colors">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Inscreva-se Agora</h2>
          <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
          <p class="text-lg text-gray-700 max-w-2xl mx-auto">
            Garanta sua vaga no PHPeste 2025 e faça parte da comunidade PHP do Nordeste.
          </p>
        </div>
        
        <div class="max-w-lg mx-auto bg-gray-100 rounded-lg shadow-lg overflow-hidden">
          <div class="gradient-bg text-white p-6 text-center">
            <h3 class="text-2xl font-bold mb-2">Formulário de Inscrição</h3>
            <p>Preencha seus dados para garantir sua vaga</p>
          </div>
          
          <form class="p-6 space-y-4">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
              <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
            </div>
            
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
              <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
            </div>
            
            <div>
              <label for="ticket" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Ingresso</label>
              <select id="ticket" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                <option value="">Selecione o tipo de ingresso</option>
                <option value="half">Meia-entrada</option>
                <option value="solidarity">Entrada Solidária</option>
                <option value="full">Inteira</option>
              </select>
            </div>
            
            <div>
              <label class="flex items-center">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <span class="ml-2 text-sm text-gray-700">Adicionar camisa do evento</span>
              </label>
            </div>
            
            <div>
              <label class="flex items-center">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <span class="ml-2 text-sm text-gray-700">Concordo com os termos e condições</span>
              </label>
            </div>
            
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
              Finalizar Inscrição
            </button>
          </form>
        </div>
      </div>
    </section>
    
    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-100 transition-colors">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Contato</h2>
          <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
          <p class="text-lg text-gray-700 max-w-2xl mx-auto">
            Tem alguma dúvida? Entre em contato conosco.
          </p>
        </div>
        
        <div class="flex flex-col md:flex-row md:space-x-8">
          <div class="md:w-1/2 mb-8 md:mb-0">
            <form class="bg-white rounded-lg shadow-md p-6 space-y-4">
              <div>
                <label for="contact-name" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input type="text" id="contact-name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
              </div>
              
              <div>
                <label for="contact-email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <input type="email" id="contact-email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
              </div>
              
              <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Assunto</label>
                <input type="text" id="subject" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
              </div>
              
              <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensagem</label>
                <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-600 focus:border-transparent"></textarea>
              </div>
              
              <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                Enviar Mensagem
              </button>
            </form>
          </div>
          
          <div class="md:w-1/2">
            <div class="bg-white rounded-lg shadow-md p-6 h-full">
              <h3 class="text-xl font-bold text-gray-900 mb-6">Informações de Contato</h3>
              
              <div class="space-y-6">
                <div class="flex items-start">
                  <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                    <i class="fas fa-envelope text-indigo-600"></i>
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900">E-mail</h4>
                    <p class="text-gray-700">contato@phpeste.net</p>
                  </div>
                </div>
                
                <div class="flex items-start">
                  <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                    <i class="fas fa-map-marker-alt text-indigo-600"></i>
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900">Local do Evento</h4>
                    <p class="text-gray-700">UESPI - Av. Nossa Sra. de Fátima, s/n - Parnaíba/PI</p>
                  </div>
                </div>
                
                <div class="flex items-start">
                  <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                    <i class="fas fa-share-alt text-indigo-600"></i>
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900">Redes Sociais</h4>
                    <div class="flex space-x-4 mt-2">
                      <a href="#" class="text-indigo-600 hover:text-indigo-800 transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                      </a>
                      <a href="#" class="text-indigo-600 hover:text-indigo-800 transition-colors">
                        <i class="fab fa-facebook text-xl"></i>
                      </a>
                      <a href="#" class="text-indigo-600 hover:text-indigo-800 transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                      </a>
                      <a href="#" class="text-indigo-600 hover:text-indigo-800 transition-colors">
                        <i class="fab fa-github text-xl"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
          <div class="mb-6 md:mb-0">
            <a href="#" class="font-bold text-2xl text-indigo-400">
              <span class="text-indigo-300">PHP</span>este 2025
            </a>
            <p class="mt-2 text-gray-400">O maior evento de PHP do Nordeste</p>
          </div>
          
          <div class="flex flex-col items-center md:items-end">
            <div class="flex space-x-4 mb-4">
              <a href="#" class="text-gray-400 hover:text-white transition-colors">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors">
                <i class="fab fa-github"></i>
              </a>
            </div>
            <p class="text-gray-400 text-sm">&copy; 2025 PHPeste. Todos os direitos reservados.</p>
          </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-800 text-center">
          <a href="#register" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md transition-colors">
            👉 Inscreva-se agora
          </a>
        </div>
      </div>
    </footer>
  </div>
</template>
