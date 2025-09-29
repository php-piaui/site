<script setup></script>

<template>
  <section id="speakers" class="py-16 bg-white transition-colors">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Palestrantes</h2>
        <div class="w-24 h-1 bg-violet-600 mx-auto mb-6"></div>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto">
          Conheça os especialistas que compartilharão conhecimento no PHPeste 2025.
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Monica Craveiro -->
        <div
          class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <div class="p-6">
            <div class="flex items-center justify-center mb-4">
              <div class="w-24 h-24 rounded-full bg-violet-100 flex items-center justify-center">
                <img class="w-24 h-24 rounded-full" src="/images/monica_craveiro.jpeg" alt="" />
                <!-- <span class="text-3xl text-violet-600">MC</span> -->
              </div>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Monica Craveiro</h3>
            <div class="flex justify-center">
              <span
                class="inline-block bg-green-700 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full"
                >Confirmada</span
              >
            </div>
            <p class="text-center text-gray-600 mt-4">
              <!-- Especialista em PHP e Arquitetura de Software -->
            </p>
          </div>
        </div>
        
        <!-- Vitor Mattos -->
        <div
          class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <div class="p-6">
            <div class="flex items-center justify-center mb-4">
              <div class="w-24 h-24 rounded-full bg-violet-100 flex items-center justify-center">
                <img class="w-24 h-24 rounded-full" src="/images/vitor_mattos.jpg" alt="" />
              </div>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Vitor Mattos</h3>
            <div class="flex justify-center">
              <span
                class="inline-block bg-green-700 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full"
                >Confirmada</span
              >
            </div>
            <p class="text-center text-gray-600 mt-4">
              <!-- Especialista em PHP e Arquitetura de Software -->
            </p>
          </div>
        </div>
        
        <!-- Ricardo Coelho -->
        <div
          class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <div class="p-6">
            <div class="flex items-center justify-center mb-4">
              <div class="w-24 h-24 rounded-full bg-violet-100 flex items-center justify-center">
                <img class="w-24 h-24 rounded-full" src="/images/ricardo_coelho.jpg" alt="" />
              </div>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Ricardo Coelho</h3>
            <div class="flex justify-center">
              <span
                class="inline-block bg-green-700 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full"
                >Confirmada</span
              >
            </div>
            <p class="text-center text-gray-600 mt-4">
              <!-- Especialista em PHP e Arquitetura de Software -->
            </p>
          </div>
        </div>

        <!-- Gustavo Web -->
        <div
          class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <div class="p-6">
            <div class="flex items-center justify-center mb-4">
              <div class="w-24 h-24 rounded-full bg-violet-100 flex items-center justify-center">
                <img class="w-24 h-24 rounded-full" src="/images/gustavo_web.jpg" alt="" />
              </div>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Gustavo Web</h3>
            <div class="flex justify-center">
              <span
                class="inline-block bg-green-700 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full"
                >Confirmado</span
              >
            </div>
            <p class="text-center text-gray-600 mt-4">
              <!-- Especialista em PHP, Laravel e Microsserviços -->
            </p>
          </div>
        </div>

        <!-- Porã -->
        <div
          class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 duration-300"
          data-aos="fade-up"
          data-aos-delay="300"
        >
          <div class="p-6">
            <div class="flex items-center justify-center mb-4">
              <div class="w-24 h-24 rounded-full bg-violet-100 flex items-center justify-center">
                <img class="w-24 h-24 rounded-full" src="/images/uira_pora.jpg" alt="" />
              </div>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Uirá Porã</h3>
            <div class="flex justify-center">
              <span
                class="inline-block bg-green-700 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full"
                >Confirmado</span
              >
            </div>
            <p class="text-center text-gray-600 mt-4">
              <!-- Especialista em Segurança e PHP Moderno -->
            </p>
          </div>
        </div>
      </div>

      <!-- Coming Soon Speakers -->
      <div class="mt-12 bg-gray-100 rounded-lg p-8 text-center" data-aos="fade-up">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Mais palestrantes em breve</h3>
        <p class="text-gray-700">
          Estamos confirmando mais especialistas para o PHPeste 2025. Fique atento às nossas redes
          sociais para novidades!
        </p>
      </div>
    </div>
  </section>
</template>

<style scoped></style>
