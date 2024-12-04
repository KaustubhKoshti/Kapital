
document.querySelectorAll('.panel').forEach(panel => {

    panel.addEventListener('click', function() {
        window.location.href = this.querySelector('a').getAttribute('href');
    });


    panel.addEventListener('mouseover', function() {
        this.style.backgroundColor = '#c5cae9';
        this.style.transform = 'scale(1.05)';
    });

    panel.addEventListener('mouseout', function() {
        this.style.backgroundColor = '#ffffff';
        this.style.transform = 'scale(1)';
    });


    panel.addEventListener('mousedown', function() {
        this.style.transform = 'scale(0.95)';
    });

    panel.addEventListener('mouseup', function() {
        this.style.transform = 'scale(1.05)';
    });
});


document.querySelectorAll('.footer-links a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').split('#')[1];
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop,
                behavior: 'smooth'
            });
        } else {
            window.location.href = this.getAttribute('href');
        }
    });
});


function highlightActivePanel() {
    const currentURL = window.location.href.split('/').pop();
    document.querySelectorAll('.panel a').forEach(link => {
        const panelURL = link.getAttribute('href').split('/').pop();
        if (panelURL === currentURL) {
            link.parentElement.style.border = '2px solid #3f51b5';
            link.parentElement.style.backgroundColor = '#e8eaf6';
        } else {
            link.parentElement.style.border = '1px solid transparent';
            link.parentElement.style.backgroundColor = '#ffffff';
        }
    });
}


highlightActivePanel();
