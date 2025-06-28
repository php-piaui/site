<template>
  <Header />
  <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="text-center">
          <!-- Status Badge -->
          <div
            class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-800 text-sm font-medium mb-6"
          >
            <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
            Call for Papers Aberto
          </div>

          <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6">
            Compartilhe seu
            <span
              class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"
            >
              conhecimento
            </span>
          </h1>

          <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
            Junte-se a nós no PHPeste 2025 em Parnaíba-PI e inspire a comunidade PHP do Nordeste.
            Submeta sua palestra e faça parte do maior evento de PHP da região.
          </p>

          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <button
              @click="scrollToSubmission"
              class="hover:cursor-pointer bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200"
            >
              Submeter Palestra
            </button>
            <!-- <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-xl font-semibold hover:border-blue-600 hover:text-blue-600 transition-colors">
              Ver Diretrizes
            </button> -->
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto">
            <div class="text-center">
              <div class="text-3xl font-bold text-blue-600 mb-2">350+</div>
              <div class="text-gray-600">Participantes esperados</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-purple-600 mb-2">20+</div>
              <div class="text-gray-600">Palestras selecionadas</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-blue-600 mb-2">2</div>
              <div class="text-gray-600">Dias de evento</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-purple-600 mb-2">100%</div>
              <div class="text-gray-600">Arretado</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Cronograma -->
    <section id="cronograma" class="py-16 lg:py-24 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Cronograma Importante</h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Fique atento aos prazos para não perder a oportunidade
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <div class="relative bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl">
            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Submissões Abertas</h3>
            <p class="text-gray-600 mb-4">Período para envio das propostas de palestras</p>
            <div class="text-lg font-semibold text-blue-600">16 Jun - 11 Ago 2025</div>
          </div>

          <div class="relative bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-2xl">
            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Avaliação</h3>
            <p class="text-gray-600 mb-4">Período de análise das propostas pela comissão</p>
            <div class="text-lg font-semibold text-purple-600">12 Ago - 17 Ago 2025</div>
          </div>

          <div class="relative bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl">
            <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Resultado</h3>
            <p class="text-gray-600 mb-4">Divulgação das palestras selecionadas</p>
            <div class="text-lg font-semibold text-green-600">17 Ago 2025</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Diretrizes -->
    <section id="diretrizes" class="py-16 lg:py-24 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
            Diretrizes para Submissão
          </h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Tudo que você precisa saber para submeter sua palestra
          </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <div class="space-y-8">
            <div class="flex items-start space-x-4">
              <div
                class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 mt-1"
              >
                <span class="text-white font-bold text-sm">1</span>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Temas Aceitos</h3>
                <p class="text-gray-600">
                  Carreira, Desenvolvimento Pessoal, PHP, Frameworks (Laravel, Symfony), APIs,
                  DevOps, Testes, Segurança, Performance, Clean Code, Arquitetura, Inspiracional,
                  Novidades das tecnologias
                </p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div
                class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 mt-1"
              >
                <span class="text-white font-bold text-sm">2</span>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Duração</h3>
                <p class="text-gray-600">
                  Palestras de 30 ou 45 minutos. Lightning talks de 5 a 10 minutos também são
                  aceitos
                </p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div
                class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center flex-shrink-0 mt-1"
              >
                <span class="text-white font-bold text-sm">3</span>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Requisitos</h3>
                <p class="text-gray-600">Título, resumo, biografia do palestrante</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div
                class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-1"
              >
                <span class="text-white font-bold text-sm">4</span>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Benefícios</h3>
                <p class="text-gray-600">
                  Palestrantes selecionados recebem certificado, hospedagem na casa dos palestrantes
                </p>
              </div>
            </div>
          </div>

          <div class="bg-white p-8 rounded-2xl shadow-xl">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Dicas para uma boa submissão</h3>
            <div class="space-y-4">
              <div class="flex items-center space-x-3">
                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                <span class="text-gray-700">Use um título claro e atrativo</span>
              </div>
              <div class="flex items-center space-x-3">
                <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
                <span class="text-gray-700">Explique o que os participantes aprenderão</span>
              </div>
              <div class="flex items-center space-x-3">
                <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                <span class="text-gray-700">Mencione sua experiência com o tema</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section id="submission" class="py-16 lg:py-24 bg-gradient-to-r from-blue-600 to-purple-600">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
          Pronto para compartilhar seu conhecimento?
        </h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
          Junte-se aos melhores palestrantes do PHP e ajude a construir o futuro da tecnologia no
          Nordeste
        </p>

        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 mb-8">
          <div class="grid md:grid-cols-3 gap-6 text-white">
            <div>
              <div class="text-2xl font-bold mb-2">📅</div>
              <div class="font-semibold">Data do Evento</div>
              <div class="text-blue-100">03 e 04 Outubro 2025</div>
            </div>
            <div>
              <div class="text-2xl font-bold mb-2">📍</div>
              <div class="font-semibold">Local</div>
              <div class="text-blue-100">UESPI - Campus Parnaíba, Piauí</div>
            </div>
            <div>
              <div class="text-2xl font-bold mb-2">⏰</div>
              <div class="font-semibold">Deadline CFP</div>
              <div class="text-blue-100">11 de Agosto de 2025</div>
            </div>
          </div>
        </div>

        <button
          @click="openSubmissionForm"
          class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 mr-4 hover:cursor-pointer"
        >
          Submeter Agora
        </button>
      </div>
    </section>

    <Footer />
  </div>
</template>

<script setup>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import { ref } from 'vue'

// Methods
const scrollToSubmission = () => {
  document.getElementById('submission').scrollIntoView({
    behavior: 'smooth',
  })
}

const cfpFormUrl = 'https://forms.gle/ZDnYSbumfc6DpZU18'

const openSubmissionForm = () => {
  window.open(cfpFormUrl, '_blank')
}
</script>
