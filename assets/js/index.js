const links = document.querySelectorAll("#link-inscricao");

links.forEach((link) => {
  link.setAttribute(
    "href",
    "https://www.sympla.com.br/lancamento-das-comunidades-de-php-do-estado-do-piaui__2207864"
  );
});

function startCounter(targetDate) {
  const timeCounter = document.getElementById("time-counter");
  const targetDateTimestamp = new Date(targetDate).getTime();

  function updateCounter() {
    const now = new Date().getTime();
    const difference = targetDateTimestamp - now;

    if (difference <= 0) {
      clearInterval(counter);
      timeCounter.innerText = "Date Reached!";
    } else {
      const days = Math.floor(difference / (1000 * 60 * 60 * 24));
      const hours = Math.floor(
        (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((difference % (1000 * 60)) / 1000);

      timeCounter.innerText = `Tempo Restante: ${days}d ${hours}h ${minutes}m ${seconds}s`;
    }
  }

  const counter = setInterval(updateCounter, 1000);
}

window.onload = () => {
  startCounter("2023-11-10T00:00:00");
};
