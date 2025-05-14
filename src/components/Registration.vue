<script setup>
const showAlert = (e) => {
  e.preventDefault()

  alert('As inscrições serão abertas em breve!')
}
</script>

<template>
  <section id="register" class="py-16 bg-white transition-colors">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Inscreva-se Agora</h2>
        <div class="w-24 h-1 bg-violet-600 mx-auto mb-6"></div>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto">
          Garanta sua vaga no PHPeste 2025 e faça parte da comunidade PHP do Nordeste.
        </p>
      </div>

      <div class="max-w-lg mx-auto bg-gray-100 rounded-lg shadow-lg overflow-hidden">
        <!-- <div class="gradient-bg text-primary p-6 text-center">
          <h3 class="text-2xl font-bold mb-2">Formulário de Inscrição</h3>
          <p>Preencha seus dados para garantir sua vaga</p>
        </div> -->

        <!-- <form class="p-6 space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1"
              >Nome Completo</label
            >
            <input
              type="text"
              id="name"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-600 focus:border-transparent"
            />
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input
              type="email"
              id="email"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-600 focus:border-transparent"
            />
          </div>

          <div>
            <label for="ticket" class="block text-sm font-medium text-gray-700 mb-1"
              >Tipo de Ingresso</label
            >
            <select
              id="ticket"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-600 focus:border-transparent"
            >
              <option value="">Selecione o tipo de ingresso</option>
              <option value="half">Meia-entrada</option>
              <option value="solidarity">Entrada Solidária</option>
              <option value="full">Inteira</option>
            </select>
          </div>

          <div>
            <label class="flex items-center">
              <input
                type="checkbox"
                class="h-4 w-4 text-violet-600 focus:ring-violet-500 border-gray-300 rounded"
              />
              <span class="ml-2 text-sm text-gray-700">Adicionar camisa do evento</span>
            </label>
          </div>

          <div>
            <label class="flex items-center">
              <input
                type="checkbox"
                class="h-4 w-4 text-violet-600 focus:ring-violet-500 border-gray-300 rounded"
              />
              <span class="ml-2 text-sm text-gray-700">Concordo com os termos e condições</span>
            </label>
          </div>

          <button
            type="submit"
            @click="showAlert"
            class="w-full bg-violet-600 hover:bg-violet-700 text-white font-medium py-2 px-4 rounded-md transition-colors"
          >
            Finalizar Inscrição
          </button>
        </form> -->

        <button
          type="submit"
          @click="showAlert"
          class="w-full bg-violet-600 hover:bg-violet-700 hover:cursor-pointer text-white font-medium py-2 px-4 rounded-md transition-colors"
        >
          Realizar Inscrição
        </button>
      </div>
    </div>
  </section>
</template>

<style scoped></style>
