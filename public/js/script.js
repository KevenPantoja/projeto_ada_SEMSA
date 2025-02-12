function handleDistritoChange() {
    $('#selectUnidade').val('-1');
    fetchData();
}

$(document).ready(function() {
    $('#toggle-btn').click(function() {
        var sidebar = document.querySelector('#sidebar.sidebar');
        var content = document.querySelector('.content');
        var btn = document.querySelector('header');
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('collapsed');
        btn.classList.toggle('collapsed');
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');

    tooltips.forEach((tooltipEl) => {
        const tooltipText = tooltipEl.getAttribute('title'); // Texto do tooltip
        const customTooltip = document.createElement('div'); // Cria o tooltip personalizado

        customTooltip.classList.add('custom-tooltip');
        customTooltip.innerText = tooltipText;
        document.body.appendChild(customTooltip);

        tooltipEl.addEventListener('mouseenter', (event) => {
            customTooltip.style.display = 'block';
            tooltipEl.removeAttribute('title'); // Evita o tooltip padrão do Bootstrap
        });

        tooltipEl.addEventListener('mousemove', (event) => {
            const offset = 15; // Distância do cursor
            customTooltip.style.left = `${event.pageX + offset}px`;
            customTooltip.style.top = `${event.pageY + offset}px`;
        });

        tooltipEl.addEventListener('mouseleave', () => {
            customTooltip.style.display = 'none';
            tooltipEl.setAttribute('title', tooltipText); // Restaura o título
        });
    });
});
