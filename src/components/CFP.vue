<script setup>
import { ref, onMounted } from 'vue'

// Animação de entrada
const isVisible = ref(false)

onMounted(() => {
  setTimeout(() => {
    isVisible.value = true
  }, 100)
})

const cfpFormUrl = 'https://forms.gle/ZDnYSbumfc6DpZU18'

const handleCFPClick = () => {
  window.open(cfpFormUrl, '_blank')
}
</script>

<template>
  <section id="cfp" class="py-20 bg-gradient-to-br from-white via-violet-50/30 to-purple-100/50 relative overflow-hidden">
    <!-- Elementos decorativos de fundo -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute top-10 left-10 w-32 h-32 bg-violet-200/20 rounded-full blur-xl"></div>
      <div class="absolute bottom-10 right-10 w-40 h-40 bg-purple-200/20 rounded-full blur-xl"></div>
      <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-blue-200/15 rounded-full blur-lg"></div>
    </div>

    <div class="container mx-auto px-4 max-w-6xl relative z-10">
      <!-- Header da seção -->
      <div class="text-center mb-16" :class="{ 'animate-fade-in-up': isVisible }">
        <div class="inline-flex items-center gap-3 mb-4">
          <div class="w-12 h-12 bg-gradient-to-r from-violet-600 to-purple-600 rounded-lg flex items-center justify-center shadow-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h2m0 0h6m-6 0v4"></path>
            </svg>
          </div>
          <h2 class="text-5xl font-bold bg-gradient-to-r from-violet-600 to-purple-600 bg-clip-text text-transparent">
            Call for Papers
          </h2>
        </div>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
          Compartilhe seu conhecimento e faça parte do maior evento PHP do Nordeste
        </p>
      </div>

      <!-- Conteúdo principal -->
      <div class="flex flex-col lg:flex-row items-stretch gap-12" :class="{ 'animate-fade-in-up-delayed': isVisible }">
        <!-- Card principal de informações -->
        <div class="flex-1 bg-white rounded-2xl shadow-xl p-8 lg:p-10 border border-gray-100 hover:shadow-2xl transition-all duration-300">
          <div class="space-y-8">
            <!-- Título da seção -->
            <div class="text-center lg:text-left">
              <h3 class="text-3xl font-bold text-gray-900 mb-4">
                Seja um dos nossos palestrantes!
              </h3>
              <p class="text-lg text-gray-600 leading-relaxed">
                Estamos buscando profissionais apaixonados por pelo ecosistema WEB para compartilhar experiências, 
                conhecimentos e inovações que inspirem nossa comunidade.
              </p>
            </div>

            <!-- Lista de benefícios -->
            <div class="space-y-4">
              <h4 class="text-xl font-semibold text-gray-800 mb-6">O que oferecemos:</h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3">
                  <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <span class="text-gray-700">Hospedagem na casa dos palestrantes</span>
                </div>
                <div class="flex items-start gap-3">
                  <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <span class="text-gray-700">Networking exclusivo</span>
                </div>
                <div class="flex items-start gap-3">
                  <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <span class="text-gray-700">Certificado de palestrante</span>
                </div>
              </div>
            </div>

            <!-- Temas sugeridos -->
            <div class="bg-gradient-to-r from-violet-50 to-purple-50 rounded-xl p-6">
              <h4 class="text-lg font-semibold text-gray-800 mb-4">Temas que nos interessam:</h4>
              <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">Carreira</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">Desenvolvimento Pessoal</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">Frameworks</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">Clean Code</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">DevOps</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">Testes</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">Performance</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">APIs</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">Inspiracional</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">Novidades das tecnologias</span>
                <span class="px-3 py-1.5 bg-white text-violet-700 rounded-full text-sm font-medium shadow-sm">PHP</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Card de CTA -->
        <div class="lg:w-96 bg-gradient-to-br from-violet-600 to-purple-700 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
          <!-- Elementos decorativos -->
          <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
          <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
          
          <div class="relative z-10 h-full flex flex-col justify-between">
            <div class="text-center mb-8">
              <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold mb-4">Pronto para se inscrever?</h3>
              <p class="text-violet-100 leading-relaxed">
                Preencha nosso formulário e conte-nos sobre sua proposta de palestra.
              </p>
            </div>

            <div class="space-y-6">
              <!-- Informações importantes -->
              <div class="bg-white/10 rounded-lg p-4 backdrop-blur-sm">
                <div class="space-y-2 text-sm">
                  <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-violet-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-violet-100">Prazo: 11 de Agosto</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-violet-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-violet-100">Local: UESPI - Campus Parnaíba, PI</span>
                  </div>
                </div>
              </div>

              <!-- Botão CTA -->
              <button
                @click="handleCFPClick"
                class="w-full bg-white text-violet-700 font-bold py-4 px-6 rounded-xl hover:bg-violet-50 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl group"
              >
                <span class="flex items-center justify-center gap-2">
                  Enviar Proposta
                  <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                  </svg>
                </span>
              </button>

              <p class="text-xs text-violet-200 text-center">
                <!-- * Processo de seleção transparente e criterioso -->
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
}

.animate-fade-in-up-delayed {
  animation: fadeInUp 0.8s ease-out 0.2s forwards;
  opacity: 0;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Hover effects adicionais */
.container > div:first-child h2 {
  position: relative;
}

.container > div:first-child h2::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, #7c3aed, #a855f7);
  border-radius: 2px;
}

/* Responsividade aprimorada */
@media (max-width: 768px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }
  
  .flex-col.lg\\:flex-row {
    gap: 2rem;
  }
}
</style>
