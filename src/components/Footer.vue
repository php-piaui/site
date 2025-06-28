<script setup>
const year = new Date().getFullYear()
</script>

<template>
  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-4 gap-8">
        <div class="col-span-2">
          <div class="flex items-center space-x-3 mb-4">
            <div
              class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center"
            >
              <span class="text-white font-bold text-lg">P</span>
            </div>
            <div>
              <h3 class="text-xl font-bold">PHPeste 2025</h3>
              <p class="text-gray-400">Parnaíba, Piauí</p>
            </div>
          </div>
          <p class="text-gray-400 mb-4">
            O maior evento de PHP do Nordeste. Conectando desenvolvedores, compartilhando
            conhecimento e construindo o futuro da tecnologia.
          </p>
        </div>

        <div>
          <h4 class="font-semibold mb-4">Links Úteis</h4>
          <div class="space-y-2">
            <!-- <a href="#" class="text-gray-400 hover:text-white transition-colors block"
              >Código de Conduta</a
            > -->
            <a
              href="https://wa.me/5586999692453"
              target="_blank"
              class="text-gray-400 hover:text-white transition-colors block"
              >Patrocínio</a
            >
            <a
              href="https://wa.me/5586999692453"
              target="_blank"
              class="text-gray-400 hover:text-white transition-colors block"
              >Contato</a
            >
          </div>
        </div>

        <div>
          <h4 class="font-semibold mb-4">Redes Sociais</h4>
          <div class="space-y-2">
            <a
              href="https://www.instagram.com/phpeste/"
              target="_blank"
              class="text-gray-400 hover:text-white transition-colors block"
              >Instagram</a
            >
            <a
              href="https://www.linkedin.com/company/phpeste/about/"
              target="_blank"
              class="text-gray-400 hover:text-white transition-colors block"
              >LinkedIn</a
            >
          </div>
        </div>
      </div>

      <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
        <p>&copy; {{ year }} PHPeste. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>
</template>

<style scoped></style>
