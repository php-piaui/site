<script setup>
const mandacaruSponsors = [
  {
    name: 'EXA',
    logo: '/images/sponsors/logoexa.jpeg',
    website: 'https://www.exa.com.br/',
    description: '',
  },
]

const cajuSponsors = [
  {
    name: 'TechCorp',
    logo: 'TECH',
    website: 'https://techcorp.com',
    description: '',
  },
]

const oitiSponsors = [
  {
    name: 'PHP SP',
    logo: 'https://phpsp.org.br/assets/images/phpsp/phpsp.png',
    website: 'https://phpsp.org.br/',
    description: '',
  },
  {
    name: 'Fox Inline',
    logo: '/images/sponsors/foxinline.svg',
    website: 'https://www.instagram.com/foxinlinetech/',
    description: '',
  },
]

const otherSponsors = [
  {
    name: 'Deputado Estadual Dr. Hélio',
    logo: '',
    // website: "https://phpsp.org.br/",
    description: '',
  },
  {
    name: 'Agência QI',
    logo: '',
    // website: "https://www.instagram.com/foxinlinetech/",
    description: '',
  },
]

const apoioInstitucional = [
  {
    name: 'UESPI - Parnaíba',
    logo: 'https://upload.wikimedia.org/wikipedia/commons/7/70/Bras%C3%A3o_da_UESPI.svg',
    website: 'https://uespi.br/tag/parnaiba/',
    description: '',
  },
  {
    name: 'Prefeitura Municipal de Parnaíba',
    logo: 'https://minhacasaminhavida.parnaiba.pi.gov.br/_next/image?url=%2Fimages%2Flogo%2Flogo_phb.png&w=640&q=75',
    website: 'https://parnaiba.pi.gov.br',
    description: '',
  },
]

// Função para criar card de patrocinador
function createSponsorCard(sponsor, type) {
  const cardClass =
    type === 'mandacaru'
      ? 'mandacaru-card'
      : type === 'caju'
        ? 'caju-card'
        : type === 'otherSponsors'
          ? 'otherSponsors-card'
          : type === 'oiti'
            ? 'oiti-card'
            : ''

  const logoSize =
    type === 'mandacaru'
      ? 'w-72 h-72'
      : type === 'caju'
        ? 'w-58 h-58'
        : type === 'otherSponsors'
          ? 'w-24 h-24'
          : type === 'oiti'
            ? 'w-48 h-48'
            : 'w-36 h-36'

  return `
        <div class="rounded-lg flex items-center justify-center transition-all duration-300 hover:shadow-md sponsor-logo ${cardClass}">
            <div class="text-center">
                <div class="${logoSize} flex mx-auto bg-gray-100 rounded-lg flex items-center justify-center mb-4 border-2 border-gray-200">
                    ${
                      sponsor.logo
                        ? `<img src="${sponsor.logo}" alt="${sponsor.name}" class="w-full h-full object-contain">`
                        : `<div class="text-gray-400 italic">${sponsor.name}</div>`
                    }
                    <!-- <img src="${sponsor.logo}" alt="${sponsor.name}" class="w-full h-full object-contain"> -->
                </div>
                <h4 class="font-bold text-gray-900 mb-2">${sponsor.name}</h4>
                <p class="text-sm text-gray-600">${sponsor.description}</p>
            </div>
        </div>
    `
}

// Função para renderizar patrocinadores
function renderSponsors() {
  // Mandacarú (2 por linha)
  const mandacaruContainer = document.getElementById('mandacaru-sponsors')
  mandacaruContainer.innerHTML = mandacaruSponsors
    .map((sponsor) => createSponsorCard(sponsor, 'mandacaru'))
    .join('')

  // Caju (3 por linha)
  // const cajuContainer = document.getElementById('caju-sponsors');
  // cajuContainer.innerHTML = cajuSponsors.map(sponsor =>
  //     createSponsorCard(sponsor, 'caju')
  // ).join('');

  // Oiti (4 por linha)
  const oitiContainer = document.getElementById('oiti-sponsors')
  oitiContainer.innerHTML = oitiSponsors
    .map((sponsor) => createSponsorCard(sponsor, 'oiti'))
    .join('')

  const otherSponsorsContainer = document.getElementById('other-sponsors')
  otherSponsorsContainer.innerHTML = otherSponsors
    .map((sponsor) => createSponsorCard(sponsor, 'otherSponsors'))
    .join('')

  // Apoio Institucional
  const apoioContainer = document.getElementById('apoio-sponsors')
  apoioContainer.innerHTML = apoioInstitucional
    .map((sponsor) => createSponsorCard(sponsor, 'apoio'))
    .join('')
}

// Inicializar quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function () {
  renderSponsors()

  // Inicializar AOS (Animate On Scroll)
  if (typeof AOS !== 'undefined') {
    AOS.init({
      duration: 800,
      once: true,
    })
  }

  // Adicionar eventos de click para os patrocinadores (opcional)
  document.addEventListener('click', function (e) {
    const sponsorCard = e.target.closest('.sponsor-logo')
    if (sponsorCard) {
      console.log('Patrocinador clicado:', sponsorCard)
      // Aqui você pode adicionar lógica para abrir o site do patrocinador
    }
  })
})

// Função para adicionar novo patrocinador (uso futuro)
function addSponsor(type, sponsorData) {
  switch (type) {
    case 'mandacaru':
      mandacaruSponsors.push(sponsorData)
      break
    case 'caju':
      cajuSponsors.push(sponsorData)
      break
    case 'oiti':
      oitiSponsors.push(sponsorData)
      break
    case 'otherSponsors':
      otherSponsors.push(sponsorData)
      break
    case 'apoio':
      apoioInstitucional.push(sponsorData)
      break
  }
  renderSponsors()
}
</script>

<template>
  <section id="sponsors" class="py-16 bg-gray-100 transition-colors">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Patrocinadores e Apoio</h2>
        <div class="w-24 h-1 bg-violet-600 mx-auto mb-6"></div>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto">
          Conheça as empresas e instituições que tornam o PHPeste 2025 possível.
        </p>
      </div>

      <!-- Cota Mandacarú (Máximo 2 por linha) -->
      <div class="mb-16" data-aos="fade-up" data-aos-delay="100">
        <h3 class="text-2xl font-bold text-center mb-8 text-red-600">Mandacarú</h3>
        <div
          id="mandacaru-sponsors"
          class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto"
        >
          <!-- Patrocinadores Mandacarú serão inseridos aqui -->
        </div>
      </div>

      <!-- Cota Caju (Máximo 3 por linha) -->
      <!-- <div class="mb-16" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-2xl font-bold text-center mb-8 text-orange-600">Caju</h3>
            <div id="caju-sponsors" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto"> -->
      <!-- Patrocinadores Caju serão inseridos aqui -->
      <!-- </div>
        </div> -->

      <!-- Cota Oiti (Máximo 4 por linha) -->
      <div class="mb-12" data-aos="fade-up" data-aos-delay="300">
        <h3 class="text-2xl font-bold text-center mb-8 text-yellow-600">Oiti</h3>
        <div
          id="oiti-sponsors"
          class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-7xl mx-auto"
        >
          <!-- Patrocinadores Oiti serão inseridos aqui -->
        </div>
      </div>

      <!-- Patrocinadores (Máximo 6 por linha) -->
      <div class="mb-12" data-aos="fade-up" data-aos-delay="300">
        <h3 class="text-2xl font-bold text-center mb-8 text-yellow-600">Quem também patrocina</h3>
        <div
          id="other-sponsors"
          class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-7xl mx-auto"
        >
          <!-- Demais patrocinadores serão inseridos aqui -->
        </div>
      </div>

      <!-- Apoio Institucional -->
      <div class="mt-16" data-aos="fade-up" data-aos-delay="400">
        <h3 class="text-2xl font-bold text-center mb-8 text-violet-600">Apoio Institucional</h3>
        <div
          id="apoio-sponsors"
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto"
        >
          <!-- Apoios Institucionais serão inseridos aqui -->
        </div>
      </div>

      <!-- Call for Sponsors -->
      <div class="mt-12 bg-violet-100 rounded-lg p-8 text-center" data-aos="fade-up">
        <h3 class="text-xl font-bold text-violet-800 mb-4">Seja um Patrocinador</h3>
        <p class="text-violet-700 mb-6">
          Sua empresa quer fazer parte do maior evento de PHP do Nordeste? Entre em contato conosco
          e conheça nossos planos de patrocínio.
        </p>
        <a
          href="https://wa.me/5586999692453 "
          target="_blank"
          rel="noopener noreferrer"
          class="inline-block bg-violet-600 hover:bg-violet-700 text-white font-medium py-2 px-6 rounded-lg shadow-md transition-colors"
        >
          Quero ser patrocinador
        </a>
      </div>
    </div>
  </section>
</template>

<style scoped>
.sponsor-logo {
  transition: transform 0.3s ease;
}
.sponsor-logo:hover {
  transform: scale(1.05);
}
.mandacaru-card {
  border-top: 4px solid #dc2626;
}
.caju-card {
  border-top: 4px solid #ea580c;
}
.oiti-card {
  border-top: 4px solid #ca8a04;
}
</style>
