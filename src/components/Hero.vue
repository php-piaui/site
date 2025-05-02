<script setup></script>

<template>
  <section class="gradient-bg bg-violet-800 text-white py-16 md:py-24">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">PHPeste 2025</h1>
          <h2 class="text-xl md:text-2xl font-semibold mb-6">O maior evento de PHP do Nordeste</h2>
          <div class="mb-8">
            <div class="flex items-start mb-3">
              <i class="fas fa-map-marker-alt mt-1 mr-3 text-violet-300"></i>
              <p>UESPI - Av. Nossa Sra. de Fátima, s/n - Parnaíba/PI</p>
            </div>
            <div class="flex items-start">
              <i class="fas fa-calendar-alt mt-1 mr-3 text-violet-300"></i>
              <p>Em breve</p>
            </div>
          </div>
          <a
            href="#register"
            class="inline-block bg-white text-violet-700 font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-gray-100 transition-colors transform hover:scale-105 duration-200"
          >
            👉 Inscreva-se agora
          </a>
        </div>

        <div class="md:w-1/2 flex justify-center" data-aos="fade-left">
          <div class="relative">
            <svg
              class="w-64 h-64 md:w-80 md:h-80 text-white opacity-10"
              viewBox="0 0 24 24"
              fill="currentColor"
            >
              <path
                d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-3.339c-1.456-.741-3.369-1.454-5.593-1.585V0h-2.372v2.143c-3.283.319-5.404 2.154-5.404 5.08 0 2.637 2.085 4.247 5.429 5.393 2.509.853 3.315 1.587 3.315 2.487 0 .944-.761 1.5-2.031 1.5-1.681 0-4.793-.876-6.643-2.19l-.902 3.616c1.611.973 4.053 1.792 6.576 1.903V24h2.371v-4.032c3.352-.319 5.591-2.287 5.591-5.397-.001-2.499-1.742-4.132-5.862-5.421z"
              />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
              <span
                class="text-4xl md:text-6xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-violet-400 to-violet-300"
                >2025</span
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"
    ></div>
  </section>
</template>

<style scoped></style>
