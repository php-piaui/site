<script setup></script>

<template>
  <section id="contact" class="py-16 bg-gray-100 transition-colors">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Contato</h2>
        <div class="w-24 h-1 bg-violet-600 mx-auto mb-6"></div>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto">
          Tem alguma dúvida? Entre em contato conosco.
        </p>
      </div>

      <div class="flex flex-col md:flex-row md:space-x-8">
        <!-- <div class="md:w-1/2 mb-8 md:mb-0">
          <form class="bg-white rounded-lg shadow-md p-6 space-y-4">
            <div>
              <label for="contact-name" class="block text-sm font-medium text-gray-700 mb-1"
                >Nome</label
              >
              <input
                type="text"
                id="contact-name"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-600 focus:border-transparent"
              />
            </div>

            <div>
              <label for="contact-email" class="block text-sm font-medium text-gray-700 mb-1"
                >E-mail</label
              >
              <input
                type="email"
                id="contact-email"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-600 focus:border-transparent"
              />
            </div>

            <div>
              <label for="subject" class="block text-sm font-medium text-gray-700 mb-1"
                >Assunto</label
              >
              <input
                type="text"
                id="subject"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-600 focus:border-transparent"
              />
            </div>

            <div>
              <label for="message" class="block text-sm font-medium text-gray-700 mb-1"
                >Mensagem</label
              >
              <textarea
                id="message"
                rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-violet-600 focus:border-transparent"
              ></textarea>
            </div>

            <button
              type="submit"
              class="w-full bg-violet-600 hover:bg-violet-700 text-white font-medium py-2 px-4 rounded-md transition-colors"
            >
              Enviar Mensagem
            </button>
          </form>
        </div> -->

        <div class="w-full">
          <div class="bg-white rounded-lg shadow-md p-6 h-full">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Informações de Contato</h3>

            <div class="space-y-6">
              <div class="flex items-start">
                <div
                  class="w-10 h-10 rounded-full bg-violet-100 flex items-center justify-center mr-4"
                >
                  <i class="fas fa-envelope text-violet-600"></i>
                </div>
                <div>
                  <h4 class="font-medium text-gray-900">E-mail</h4>
                  <p class="text-gray-700">phppiaui@gmail.com</p>
                </div>
              </div>

              <div class="flex items-start">
                <div
                  class="w-10 h-10 rounded-full bg-violet-100 flex items-center justify-center mr-4"
                >
                  <i class="fas fa-map-marker-alt text-violet-600"></i>
                </div>
                <div>
                  <h4 class="font-medium text-gray-900">Local do Evento</h4>
                  <p class="text-gray-700">UESPI - Av. Nossa Sra. de Fátima, s/n - Parnaíba/PI</p>
                </div>
              </div>

              <div class="flex items-start">
                <div
                  class="w-10 h-10 rounded-full bg-violet-100 flex items-center justify-center mr-4"
                >
                  <i class="fas fa-share-alt text-violet-600"></i>
                </div>
                <div>
                  <h4 class="font-medium text-gray-900">Redes Sociais</h4>
                  <div class="flex space-x-4 mt-2">
                    <a href="#" class="text-violet-600 hover:text-violet-800 transition-colors">
                      <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="https://chat.whatsapp.com/GKlSwf1hqw5DwNqxM9YydU" target="_blank" class="text-violet-600 hover:text-violet-800 transition-colors">
                      <i class="fab fa-twitter text-xl"></i>
                      WhatsApp
                    </a>
                    <a href="https://www.instagram.com/php.piaui/" target="_blank" class="text-violet-600 hover:text-violet-800 transition-colors">
                      <i class="fab fa-instagram text-xl"></i>
                      Instagram
                    </a>
                    <a href="#" class="text-violet-600 hover:text-violet-800 transition-colors">
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
</template>

<style scoped></style>
