<script setup>
import { ref } from 'vue'
const mobileMenuOpen = ref(false)
</script>

<template>
  <header
    class="sticky top-0 z-50 transition-colors bg-white bg-opacity-90 backdrop-filter backdrop-blur-lg shadow-md"
  >
    <div class="container mx-auto px-4 py-3">
      <div class="flex justify-between items-center">
        <a href="#" class="font-bold text-2xl text-indigo-600">
          <span class="text-indigo-800">PHP</span>este
        </a>

        <div class="flex items-center space-x-4">
          <nav class="hidden md:flex space-x-6">
            <a href="#about" class="text-gray-700 hover:text-indigo-600 transition-colors">Sobre</a>
            <a href="#tickets" class="text-gray-700 hover:text-indigo-600 transition-colors"
              >Ingressos</a
            >
            <a href="#speakers" class="text-gray-700 hover:text-indigo-600 transition-colors"
              >Palestrantes</a
            >
            <a href="#sponsors" class="text-gray-700 hover:text-indigo-600 transition-colors"
              >Patrocinadores</a
            >
          </nav>

          <a
            href="#register"
            class="hidden md:block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition-colors font-medium"
          >
            Inscreva-se
          </a>

          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="md:hidden p-2 rounded-md text-gray-700 hover:bg-gray-200 transition-colors"
          >
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </div>

      <!-- Mobile menu -->
      <div v-if="mobileMenuOpen" class="md:hidden mt-3 py-3 border-t border-gray-200">
        <nav class="flex flex-col space-y-3">
          <a
            href="#about"
            @click="mobileMenuOpen = false"
            class="text-gray-700 hover:text-indigo-600 transition-colors"
            >Sobre</a
          >
          <a
            href="#tickets"
            @click="mobileMenuOpen = false"
            class="text-gray-700 hover:text-indigo-600 transition-colors"
            >Ingressos</a
          >
          <a
            href="#speakers"
            @click="mobileMenuOpen = false"
            class="text-gray-700 hover:text-indigo-600 transition-colors"
            >Palestrantes</a
          >
          <a
            href="#sponsors"
            @click="mobileMenuOpen = false"
            class="text-gray-700 hover:text-indigo-600 transition-colors"
            >Patrocinadores</a
          >
          <a
            href="#register"
            @click="mobileMenuOpen = false"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition-colors font-medium text-center"
          >
            Inscreva-se
          </a>
        </nav>
      </div>
    </div>
  </header>
</template>

<style scoped></style>
