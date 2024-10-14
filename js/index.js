document.addEventListener("touchstart", function(event) {
    event.preventDefault();
}, { passive: true });


// navbar script
const toggler = document.getElementById('navbar-toggler');
const menu = document.getElementById('navbar-menu');

toggler.addEventListener('click', () => {
    menu.classList.toggle('hidden');
});



const slider = document.querySelector('.slider');
const sliderItems = document.querySelectorAll('.slider-item');
const paginationDots = document.querySelector('.pagination-dots');
let currentIndex = 0;
let itemsPerSlide = 1;
let totalSlides;

// Dynamically create pagination dots
function createPaginationDots() {
    paginationDots.innerHTML = '';
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('span');
        dot.classList.add('dot');
        dot.dataset.index = i;
        if (i === 0) dot.classList.add('active');
        paginationDots.appendChild(dot);
    }
}

function updateItemsPerSlide() {
    if (window.innerWidth >= 1024) {
        itemsPerSlide = 3;
    } else if (window.innerWidth >= 768) {
        itemsPerSlide = 2;
    } else {
        itemsPerSlide = 1;
    }
    totalSlides = Math.ceil(sliderItems.length / itemsPerSlide);
}

function updateSliderPosition() {
    const itemWidth = sliderItems[0].offsetWidth;
    const newTranslate = -currentIndex * itemWidth * itemsPerSlide;
    slider.style.transform = `translateX(${newTranslate}px)`;
}

function updateActiveDot() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach(dot => dot.classList.remove('active'));
    dots[currentIndex].classList.add('active');
}

function goToSlide(index) {
    currentIndex = index;
    updateSliderPosition();
    updateActiveDot();
}

paginationDots.addEventListener('click', e => {
    if (e.target.classList.contains('dot')) {
        goToSlide(parseInt(e.target.dataset.index));
    }
});

window.addEventListener('resize', () => {
    updateItemsPerSlide();
    createPaginationDots();
    updateSliderPosition();
});

// Initialize
updateItemsPerSlide();
createPaginationDots();
updateSliderPosition();



function scrollDiv(direction) {
    const scrollableDiv = document.getElementById('scrollable-div');
    
    if (direction === 'left') {
      scrollableDiv.scrollBy({ left: -100, behavior: 'smooth' }); // Scroll left by 100px
    } else if (direction === 'right') {
      scrollableDiv.scrollBy({ left: 250, behavior: 'smooth' });  // Scroll right by 100px
    } else if (direction === 'up') {
      scrollableDiv.scrollBy({ top: -100, behavior: 'smooth' });  // Scroll up by 100px
    } else if (direction === 'down') {
      scrollableDiv.scrollBy({ top: 100, behavior: 'smooth' });   // Scroll down by 100px
    }
  }



  





  