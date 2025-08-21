<script setup>
import banner from './../assets/banner.jpeg'
</script>

<template>
  <section class="relative overflow-hidden text-white py-16 md:py-48">
    <!-- Imagem de fundo -->
    <div
      class="absolute inset-0 bg-cover bg-center z-0"
      :style="`background-image: url(${banner})`"
    ></div>

    <!-- Overlay escuro para contraste -->
    <div class="absolute inset-0 z-10"></div>

    <!-- Conteúdo centralizado -->
    <div class="container mx-auto px-4 relative z-20">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
          <!-- <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">PHPeste 2025</h1> -->
          <!-- <h2 class="text-xl md:text-2xl font-semibold mb-6">O maior evento de PHP do Nordeste</h2> -->
          <div class="mb-8">
            <div class="flex items-start mb-3">
              <!-- <i class="fas fa-map-marker-alt mt-1 mr-3 text-violet-300"></i> -->
              <!-- <p>UESPI - Av. Nossa Sra. de Fátima, s/n - Parnaíba/PI</p> -->
            </div>
            <div class="flex items-start">
              <!-- <i class="fas fa-calendar-alt mt-1 mr-3 text-violet-300"></i> -->
              <!-- <p>Dias 03 e 04 de Outubro</p> -->
            </div>
          </div>
          <!-- <a
            href="#register"
            class="inline-block bg-white text-violet-700 font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-gray-100 transition-all transform hover:scale-105 ease-in-out duration-200"
          >
            👉 Inscreva-se agora
          </a> -->
        </div>

        <div class="md:w-1/2 flex justify-center" data-aos="fade-left">
          <div class="relative">
            <!-- Texto em destaque sobreposta à imagem -->
            <div class="absolute inset-0 flex items-center justify-center">
              <!-- <span
                class="text-4xl md:text-6xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-violet-400 to-violet-300"
                >2025</span
              > -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Gradiente suave na parte inferior -->
    <div
      class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent z-30"
    ></div>
  </section>

  <div class="flex flex-col lg:flex-row items-center justify-center gap-8 mb-12">
    <div class="flex flex-col items-center lg:w-1/2">
      <a
        href="#register"
        class="inline-block bg-violet-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-gray-100 transition-all transform hover:scale-105 ease-in-out duration-200 z-801"
      >
        👉 Inscreva-se agora
      </a>
    </div>
  </div>
</template>

<style scoped></style>
