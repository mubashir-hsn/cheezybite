let cards = Array.from(document.querySelectorAll('.card'));
let buttons = Array.from(document.querySelectorAll('.cart-btn')); // 'buttons' for the button list

buttons.forEach((button, index) => {
    button.addEventListener('click', () => {
        let clickedCard = cards[index]; // Get the corresponding card using the index
        // console.log('Clicked card:', clickedCard);
    });
});


