 // Selecionar o overlay do spinner
 const spinnerOverlay = document.getElementById('spinner-overlay');
//  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
//  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
 // Função para mostrar o spinner
 function showSpinner() {
   spinnerOverlay.classList.remove('hidden');
 }
 window.addEventListener('pageshow', () => {
    hideSpinner(); // Esconde o spinner ao carregar a página
});

 window.addEventListener('popstate', () => {
    hideSpinner(); // Esconde o spinner ao navegar para a página anterior
});

 function hideSpinner() {
    const spinnerOverlay = document.getElementById('spinner-overlay');
    if (spinnerOverlay) {
        spinnerOverlay.classList.add('hidden'); // Esconde o spinner
    }
}

 // Adicionar eventos para elementos com a classe 'show-spinner'
 document.addEventListener('DOMContentLoaded', () => {
   const clickableElements = document.querySelectorAll('.show-spinner');
   clickableElements.forEach(element => {
     element.addEventListener('click', (e) => {
       // Mostrar o spinner
       showSpinner();

       // Se for um link, aguardar um pequeno tempo antes de navegar
       if (element.tagName === 'A') {
         e.preventDefault(); // Impede a navegação imediata
         const href = element.getAttribute('href');
         setTimeout(() => {
           window.location.href = href; // Redirecionar após o spinner
         }, 500);
       }
     });
   });
 });
