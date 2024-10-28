import Swiper from 'swiper/bundle'

export function boxCarousel() {
  return {
    init() {
      new Swiper('.swiper-box', {
        slidesPerView: 6,
        spaceBetween: 10,
        breakpoints: {
          // when window width is >= 320px
          320: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          // when window width is >= 480px
          480: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          // when window width is >= 640px
          768: {
            slidesPerView: 4,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 6,
            spaceBetween: 10,
          },
        },
        loop: true,
        autoplay: {
          delay: 3000,
        },

        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      })
    },
  }
}

export function cardCarousel() {
  return {
    init() {
      new Swiper('.swiper-cards', {
        slidesPerView: 3,
        spaceBetween: 10,
        breakpoints: {
          // when window width is >= 320px
          320: {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          // when window width is >= 480px
          480: {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          // when window width is >= 640px
          768: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 10,
          },
        },
        loop: true,
        autoplay: {
          delay: 2000,
        },
      })
    },
  }
}
