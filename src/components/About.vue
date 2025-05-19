<script setup>
import { ref } from 'vue'

const eventInfo = ref([
  {
    icon: 'users',
    title: 'Capacidade Total',
    content: '400 pessoas',
  },
  {
    icon: 'ticket-alt',
    title: 'Preço Base',
    content: 'R$ 150,00',
  },
  {
    icon: 'calendar-alt',
    title: 'Data',
    content: '3 e 4 de Outubro',
  },
  {
    icon: 'map-marker-alt',
    title: 'Local',
    content: 'UESPI - Parnaíba/PI',
  },
])
</script>

<template>
  <section id="about" class="py-20 bg-gradient-to-b from-white to-violet-50">
    <div class="container mx-auto px-4 max-w-6xl">
      <!-- Cabeçalho da seção -->
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-900 relative inline-block">
          Sobre o Evento
          <span class="block h-1 bg-violet-600 mt-2 transform transition-all duration-300"></span>
        </h2>
      </div>

      <!-- Conteúdo principal -->
      <div class="flex flex-col lg:flex-row items-stretch gap-12">
        <!-- Coluna de texto -->
        <div class="lg:w-1/2">
          <div class="space-y-6 pr-0 lg:pr-8">
            <p class="text-lg leading-relaxed text-gray-700">
              O <span class="font-semibold text-violet-700">PHPeste</span> é o maior evento de PHP
              do Nordeste, reunindo desenvolvedores, empresas e entusiastas para compartilhar
              conhecimento, experiências e as mais recentes tendências no ecossistema PHP.
            </p>
            <p class="text-lg leading-relaxed text-gray-700">
              Em 2025, o evento chega a
              <span class="font-semibold text-violet-700">Parnaíba/PI</span> com uma programação
              repleta de palestras técnicas, workshops práticos e oportunidades de networking. Nosso
              objetivo é fortalecer a comunidade PHP no Nordeste brasileiro e proporcionar um
              ambiente de aprendizado colaborativo.
            </p>
            <p class="text-lg leading-relaxed text-gray-700">
              Não perca a oportunidade de participar deste evento único que combina conteúdo de
              qualidade, conexões valiosas e uma experiência inesquecível na bela cidade de
              Parnaíba.
            </p>
            <!-- <div class="pt-4">
              <button
                class="px-8 py-3 bg-violet-600 hover:bg-violet-700 text-white font-medium rounded-lg transition-colors duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
              >
                Inscreva-se agora
              </button>
            </div> -->
          </div>
        </div>

        <!-- Coluna de informações -->
        <div class="lg:w-1/2">
          <div
            class="bg-white rounded-xl shadow-xl p-8 border border-violet-100 relative overflow-hidden"
          >
            <div class="absolute top-0 right-0 h-24 w-24 transform translate-x-8 -translate-y-8">
              <div class="h-full w-full bg-violet-200 rounded-full opacity-20"></div>
            </div>

            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <span class="inline-block w-3 h-10 bg-violet-600 mr-4"></span>
              <span>Informações do Evento</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div
                v-for="(item, index) in eventInfo"
                :key="index"
                class="flex items-start p-4 rounded-lg transition-all duration-300 hover:bg-violet-50 group"
              >
                <div
                  class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center mr-4 group-hover:bg-violet-200 transition-colors duration-300"
                >
                  <i :class="['fas', `fa-${item.icon}`, 'text-violet-600', 'text-lg']"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900">{{ item.title }}</h4>
                  <p class="text-gray-700">{{ item.content }}</p>
                </div>
              </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100">
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <!-- <div
                    class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center mr-2"
                  >
                    <i class="fas fa-share-alt text-violet-600 text-sm"></i>
                  </div>
                  <span class="text-sm text-gray-600">Compartilhe nas redes sociais</span> -->
                </div>
                <!-- <div class="flex space-x-3">
                  <a
                    href="#"
                    class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center hover:bg-violet-200 transition-colors"
                  >
                    <i class="fab fa-twitter text-violet-600"></i>
                  </a>
                  <a
                    href="#"
                    class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center hover:bg-violet-200 transition-colors"
                  >
                    <i class="fab fa-facebook-f text-violet-600"></i>
                  </a>
                  <a
                    href="#"
                    class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center hover:bg-violet-200 transition-colors"
                  >
                    <i class="fab fa-instagram text-violet-600"></i>
                  </a>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.container {
  transition: all 0.3s ease;
}

h2 span {
  width: 100%;
}

h2:hover span {
  width: 120%;
}
</style>
