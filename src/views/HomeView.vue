<script setup>
import Header from '../components/Header.vue'
import Hero from '../components/Hero.vue'
import About from '../components/About.vue'
import CFP from '../components/CFP.vue'
import Tickets from '../components/Tickets.vue'
import Speakers from '../components/Speakers.vue'
import Sponsors from '../components/Sponsors.vue'
import Registration from '../components/Registration.vue'
import Contact from '../components/Contact.vue'
import Footer from '../components/Footer.vue'

import { cronograma_dia1, cronograma_dia2 } from '../data/cronograma.js'
</script>

<template>
  <Header />

  <Hero />

  <CFP />

  <About />

  <Tickets />

  <Speakers :cronograma="cronograma_dia1" event_day="Dia 03 de Outubro" />

  <Speakers :cronograma="cronograma_dia2" event_day="Dia 04 de Outubro" />

  <Sponsors />

  <Registration />

  <Contact />

  <Footer />
</template>
