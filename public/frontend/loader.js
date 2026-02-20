// Loader JS (adds a realistic loading progress and hides overlay on window.load)
(function () {
  const progress = document.getElementById('progress');
  const loader = document.getElementById('loader');
  if (!progress || !loader) return;

  let width = 0;

  const interval = setInterval(() => {
    if (width < 90) {
      width += Math.random() * 5;
      progress.style.width = Math.min(90, width) + '%';
    }
  }, 200);

  window.addEventListener('load', () => {
    clearInterval(interval);
    progress.style.width = '100%';

    setTimeout(() => {
      loader.classList.add('hidden');
    }, 400);
  });
})();
