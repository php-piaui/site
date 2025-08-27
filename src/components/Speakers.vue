<script setup>

const palestrantes = [
  { id: 1, estado: 'SP', nome: 'Monica Craveiro', imagem: '/images/monica_craveiro.jpeg', status: 'Confirmada' },
  { id: 2, estado: 'RJ', nome: 'Vitor Mattos', imagem: '/images/vitor_mattos.jpg', status: 'Confirmada' },
  { id: 3, estado: 'MA', nome: 'Ricardo Coelho', imagem: '/images/ricardo_coelho.jpg', status: 'Confirmada' },
  { id: 4, estado: 'SP', nome: 'Gustavo Web', imagem: '/images/gustavo_web.jpg', status: 'Confirmado' },
  { id: 5, estado: 'CE', nome: 'Uirá Porã', imagem: '/images/uira_pora.jpg', status: 'Confirmado' },
  { id: 6, estado: 'AL', nome: 'Durval Pereira', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQH81hFfrQy7_g/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1725122761027?e=1759363200&v=beta&t=BaympPqZToZUHWD7ypfmzECLjCwh-hy8MkpG1enVsV4', status: 'Confirmado' },
  { id: 7, estado: 'RN', nome: 'Sara Souza', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQGMqbPeZu2TYQ/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1722606292206?e=1759363200&v=beta&t=K9XhAk-bwEi1I3jSdtkFF7z8KFppV-YuuQ4I9mPVRQQ', status: 'Confirmado' },
  { id: 8, estado: 'PI', nome: 'Lia Mariana', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQGlpeeneuglGw/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1729195235683?e=1759363200&v=beta&t=JpixomSlx_UL0DVVe-NhU1C5e9ROkPEyx-Hgk_Jx-x8', status: 'Confirmado' },
  { id: 9, estado: 'PE', nome: 'Moisés Falcão', imagem: 'https://media.licdn.com/dms/image/v2/D4E03AQHLk321mSOyXg/profile-displayphoto-shrink_400_400/B4EZVM81U5HcAk-/0/1740752770901?e=1759363200&v=beta&t=dIUaonR4oqda3F_GI4_9-XVwlYb2KTY5GOQJ_a9eejY', status: 'Confirmado' },
  { id: 10, estado: 'PE', nome: 'Luiz Siqueira', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQE__qWq03W2tQ/profile-displayphoto-shrink_800_800/B4DZYB5Fb3HAAg-/0/1743788464468?e=1759363200&v=beta&t=zJynRzVY8NFkDCuGreaoHPUWb9f16p7cMgncNWQNVn4', status: 'Confirmado' },
  { id: 11, estado: 'PE', nome: 'Alcimar Lemos', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQECr3cDS3ElYw/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1697241965479?e=1759363200&v=beta&t=0wglzPzhoHtNDX_jv294g0II-d-1_Br-PghkGtJg688', status: 'Confirmado' },
  { id: 12, estado: 'PB', nome: 'Rodrigo Castro', imagem: 'https://media.licdn.com/dms/image/v2/C4D03AQHDemU5xIHApg/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1648121255650?e=1759363200&v=beta&t=1J3Re-ZGZFEQn1TpjYQhq9KPZrnbcCvlhZtaUMoyNTs', status: 'Confirmado' },
  { id: 13, estado: 'MA', nome: 'Abisai Santos', imagem: 'https://media.licdn.com/dms/image/v2/D5603AQGmMlORZ0Itlg/profile-displayphoto-shrink_800_800/B56ZTC9O0xGUAc-/0/1738437621493?e=1759363200&v=beta&t=dRFnz8AWMEbZtDCKhASpfgX31jpQUo7974CiRHjXjkQ', status: 'Confirmado' },
  { id: 14, estado: 'MA', nome: 'Evaldo Barbosa', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQG_V4VTSOymZQ/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1699995388185?e=1759363200&v=beta&t=1KLTnTgALDAM_fNCFxnvQ115Cv2e0qYM1GNpJFgBylA', status: 'Confirmado' },
  { id: 15, estado: 'CE', nome: 'Henrique Lopes', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQFM61N-RQ4jpA/profile-displayphoto-shrink_800_800/B4DZPgF6XlGgAc-/0/1734631466964?e=1759363200&v=beta&t=Kl4jviSD88fnajRKTAbpbwgMtyfC8EFmkwCE7pN5sec', status: 'Confirmado' },
  { id: 16, estado: 'MA', nome: 'Helena Saminez', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQGh1j4yg_J8SA/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1718220121081?e=1759363200&v=beta&t=mJDlr1GK-kNCd4r-TXURw8b44IIlpBz14Si6MV73NjQ', status: 'Confirmado' },
  { id: 17, estado: 'CE', nome: 'David Lima', imagem: 'https://media.licdn.com/dms/image/v2/D4D03AQE6k60InxG5LA/profile-displayphoto-shrink_800_800/B4DZUPbwlUGcAc-/0/1739720690723?e=1759363200&v=beta&t=66IXBGPp5xXjVQaTodNN7wj-EHQ4dsjLuJgnp2mu0AY', status: 'Confirmado' },
]
</script>

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
          v-for="palestrante in palestrantes"
          :key="palestrante.id"
        >
          <div class="p-6">
            <div class="flex items-center justify-center mb-4">
              <div class="w-24 h-24 rounded-full bg-violet-100 flex items-center justify-center">
                <img class="w-24 h-24 rounded-full" :src="palestrante.imagem" alt="" />
                <!-- <span class="text-3xl text-violet-600">MC</span> -->
              </div>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">{{ palestrante.nome }}</h3>
            <div class="flex justify-center">
              <span
                class="inline-block bg-green-700 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full"
                >{{ palestrante.status }}</span
              >
              <span
                class="inline-block bg-violet-700 text-violet-800 dark:text-violet-200 text-xs font-semibold px-2 py-1 rounded-full ml-2"
                >{{ palestrante.estado }}</span
              >
            </div>
            <p class="text-center text-gray-600 mt-4">
              <!-- Especialista em PHP e Arquitetura de Software -->
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
