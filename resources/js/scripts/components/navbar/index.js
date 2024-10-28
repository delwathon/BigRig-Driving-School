export function navbar() {
  return {
    scrolled: false,
    height: 60,
    mobileOpen: false,
    isChecked: false,
    megamenuOpened: false,
    openedMegamenu: '',
    scroll() {
      let scrollValue = window.scrollY
      if (scrollValue >= this.height) {
        this.scrolled = true
      } else {
        this.scrolled = false
      }
    },
    openSearch() {
      const input = document.getElementById('navbar-search-field')
      this.$store.app.searchOpened = true
      input.focus()
    },
    initScrollAnchors() {
      document
        .querySelectorAll('.scroll-link[href^="#"]')
        .forEach((trigger) => {
          trigger.onclick = function (e) {
            e.preventDefault()
            let hash = this.getAttribute('href')
            let target = document.querySelector(hash)
            let headerOffset = 100
            let elementPosition = target.offsetTop
            let offsetPosition = elementPosition - headerOffset

            window.scrollTo({
              top: offsetPosition,
              behavior: 'smooth',
            })
          }
        })
    },
  }
}
