let buttons = document.querySelectorAll('.accordion-button')

buttons.forEach(button => {
    button.addEventListener('click', () => {
        let container = button.parentElement.nextElementSibling;
        // container.classList.toggle('fade-out-animation')
        //console.log(container.classList.contains('active-button'));
        if (container.classList.contains('active-button')){
            container.toggleAttribute('hidden')
        }
        container.classList.add('active-button')
    });
});