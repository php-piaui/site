<template>
  <section id="speakers" class="py-16 bg-white transition-colors">
    <div class="phpeste-schedule">
      <!-- Header -->
      <div class="schedule-header">
        <h2 class="schedule-title">
          <span class="php-logo">🐘</span>
          Cronograma {{ event_day }}
        </h2>
        <p class="schedule-subtitle">Confira a programação do {{ event_day }}</p>
      </div>

      <!-- Filtros -->
      <div class="schedule-filters">
        <div class="filter-group">
          <label for="room-filter">Filtrar por sala:</label>
          <select id="room-filter" v-model="selectedRoom" class="filter-select">
            <option value="">Todas as salas</option>
            <option v-for="room in availableRooms" :key="room" :value="room">
              {{ room }}
            </option>
          </select>
        </div>
      </div>

      <!-- Lista do Cronograma -->
      <div class="schedule-list">
        <div
          v-for="(item, index) in filteredSchedule"
          :key="index"
          class="schedule-item"
          :class="{ highlight: isCurrentTalk(item) }"
        >
          <!-- Ordem e Horário -->
          <div class="schedule-time">
            <img class="talk-speaker" :src="item.speaker_img" :alt="item.nome_palestrante" />
            <div class="time-range">
              <span class="start-time">{{ formatTime(item.horario_inicio) }}</span>
              <span class="end-time">{{ formatTime(item.horario_fim) }}</span>
            </div>
          </div>

          <!-- Conteúdo da Palestra -->
          <div class="schedule-content">
            <div class="talk-header">
              <h3 class="talk-title">{{ item.titulo_palestra }}</h3>
              <div class="talk-room">
                <span class="room-icon">📍</span>
                {{ item.sala }}
              </div>
            </div>

            <div class="speaker-info">
              <span class="speaker-name">{{ item.nome_palestrante }}</span>
            </div>

            <!-- Duração da palestra -->
            <div class="talk-duration">
              <span class="duration-icon">⏱️</span>
              <span>{{ calculateDuration(item.data, item.horario_inicio, item.horario_fim) }} minutos</span>
            </div>
          </div>

          <!-- Status Indicator -->
          <div class="status-indicator">
            <div
              class="status-dot"
              :class="getTalkStatus(item)"
              :title="getTalkStatusText(item)"
            ></div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="filteredSchedule.length === 0" class="empty-state">
        <div class="empty-icon">📅</div>
        <h3>Nenhuma palestra encontrada</h3>
        <p>Tente ajustar os filtros ou verifique se há palestras cadastradas.</p>
      </div>

      <!-- Footer -->
      <div class="schedule-footer">
        <p class="footer-text">
          Total de palestras: <strong>{{ filteredSchedule.length }}</strong>
        </p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

// Props
const props = defineProps({
  cronograma: {
    type: Array,
    required: true,
    default: () => [],
  },
  event_day: {
    type: String,
    required: true,
    default: () => "",
  },
})

// Estado reativo
const selectedRoom = ref('')
const currentTime = ref(new Date())

// Computed properties
const availableRooms = computed(() => {
  const rooms = props.cronograma.map((item) => item.sala)
  return [...new Set(rooms)].sort()
})

const filteredSchedule = computed(() => {
  let filtered = [...props.cronograma]

  // Filtro por sala
  if (selectedRoom.value) {
    filtered = filtered.filter((item) => item.sala === selectedRoom.value)
  }

  // Ordenar por horário de início
  return filtered.sort((a, b) => {
    const timeA = new Date(`1970-01-01T${a.horario_inicio}`)
    const timeB = new Date(`1970-01-01T${b.horario_inicio}`)
    return timeA - timeB
  })
})

// Métodos
const formatTime = (time) => {
  return time.substring(0, 5) // Remove os segundos se houver
}

const calculateDuration = (data, startTime, endTime) => {
  const start = new Date(`1970-01-01T${startTime}`)
  const end = new Date(`1970-01-01T${endTime}`)
  return Math.round((end - start) / (1000 * 60)) // Diferença em minutos
}

const getTalkStatus = (talk) => {
  const now = currentTime.value
  const today = new Date().toISOString().split('T')[0]
  const startTime = new Date(`${today}T${talk.horario_inicio}`)
  const endTime = new Date(`${today}T${talk.horario_fim}`)

  if (now >= startTime && now <= endTime) {
    return 'current'
  } else if (now > endTime) {
    return 'finished'
  } else {
    return 'upcoming'
  }
}

const getTalkStatusText = (talk) => {
  const status = getTalkStatus(talk)
  switch (status) {
    case 'current':
      return 'Em andamento'
    case 'finished':
      return 'Finalizada'
    case 'upcoming':
      return 'Próxima'
    default:
      return ''
  }
}

const isCurrentTalk = (talk) => {
  return getTalkStatus(talk) === 'current'
}

// Lifecycle
onMounted(() => {
  // Atualizar o tempo atual a cada minuto
  setInterval(() => {
    currentTime.value = new Date()
  }, 60000)
})
</script>

<style scoped>
.phpeste-schedule {
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px;
  font-family:
    'Inter',
    -apple-system,
    BlinkMacSystemFont,
    'Segoe UI',
    Roboto,
    sans-serif;
}

/* Header */
.schedule-header {
  text-align: center;
  margin-bottom: 30px;
  padding: 30px 20px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 16px;
  color: white;
}

.schedule-title {
  margin: 0 0 10px 0;
  font-size: 2.5rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
}

.php-logo {
  font-size: 2.5rem;
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%,
  20%,
  50%,
  80%,
  100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-10px);
  }
  60% {
    transform: translateY(-5px);
  }
}

.schedule-subtitle {
  margin: 0;
  font-size: 1.1rem;
  opacity: 0.9;
  font-weight: 300;
}

/* Filtros */
.schedule-filters {
  margin-bottom: 30px;
  padding: 20px;
  background: #f8f9fa;
  border-radius: 12px;
  border: 1px solid #e9ecef;
}

.filter-group {
  display: flex;
  align-items: center;
  gap: 12px;
}

.filter-group label {
  font-weight: 600;
  color: #495057;
  min-width: 130px;
}

.filter-select {
  padding: 8px 12px;
  border: 2px solid #dee2e6;
  border-radius: 8px;
  background: white;
  font-size: 14px;
  color: #495057;
  transition: border-color 0.3s ease;
  min-width: 200px;
  cursor: pointer;
  width: 100%;
}

.filter-select:focus {
  outline: none;
  border-color: #667eea;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Lista do Cronograma */
.schedule-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.schedule-item {
  display: grid;
  grid-template-columns: 140px 1fr 40px;
  gap: 20px;
  padding: 24px;
  background: white;
  border-radius: 12px;
  border: 2px solid #e9ecef;
  transition: all 0.3s ease;
  position: relative;
}

.schedule-item:hover {
  border-color: #667eea;
  box-shadow: 0 4px 20px rgba(102, 126, 234, 0.1);
  transform: translateY(-2px);
}

.schedule-item.highlight {
  border-color: #28a745;
  background: #f8fff9;
  box-shadow: 0 4px 20px rgba(40, 167, 69, 0.15);
}

/* Tempo e Ordem */
.schedule-time {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.talk-speaker {
  color: white;
  border-radius: 50%;
  width: 80px;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 14px;
  margin-bottom: 8px;
}

.time-range {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.start-time,
.end-time {
  font-weight: 600;
  color: #495057;
  font-size: 14px;
}

.time-separator {
  color: #6c757d;
  font-size: 12px;
}

/* Conteúdo */
.schedule-content {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.talk-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 12px;
}

.talk-title {
  margin: 0;
  font-size: 1.25rem;
  font-weight: 600;
  color: #212529;
  line-height: 1.4;
  flex: 1;
}

.talk-room {
  background: #e9ecef;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 18px;
  font-weight: 600;
  color: #495057;
  white-space: nowrap;
  display: flex;
  align-items: center;
  gap: 4px;
}

.speaker-info,
.talk-duration {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 18px;
  color: #6c757d;
}

.speaker-name {
  font-weight: 500;
  color: #495057;
}

/* Status Indicator */
.status-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
}

.status-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
}

.status-dot.upcoming {
  background-color: #6c757d;
}
status-dot
.status-dot.current {
  background-color: #28a745;
  animation: pulse 2s infinite;
}

.status-dot.finished {
  background-color: #dc3545;
}

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
  }
  70% {
    box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
  }
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #6c757d;
}

.empty-icon {
  font-size: 4rem;
  margin-bottom: 20px;
}

.empty-state h3 {
  margin: 0 0 10px 0;
  color: #495057;
}

.empty-state p {
  margin: 0;
  font-size: 14px;
}

/* Footer */
.schedule-footer {
  margin-top: 30px;
  padding: 20px;
  background: #f8f9fa;
  border-radius: 12px;
  text-align: center;
}

.footer-text {
  margin: 0;
  color: #6c757d;
  font-size: 14px;
}

/* Responsivo */
@media (max-width: 768px) {
  .phpeste-schedule {
    padding: 15px;
  }

  .schedule-title {
    font-size: 2rem;
  }

  .schedule-item {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .schedule-time {
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
  }

  .time-range {
    flex-direction: row;
    gap: 8px;
  }

  .talk-header {
    flex-direction: column;
    align-items: stretch;
    gap: 8px;
  }

  .filter-group {
    flex-direction: column;
    align-items: stretch;
    gap: 8px;
  }

  .filter-group label {
    min-width: auto;
  }

  .filter-select {
    min-width: auto;
  }
}

@media (max-width: 480px) {
  .schedule-title {
    font-size: 1.75rem;
    flex-direction: column;
    gap: 8px;
  }

  .talk-title {
    font-size: 1.1rem;
  }
}
</style>
