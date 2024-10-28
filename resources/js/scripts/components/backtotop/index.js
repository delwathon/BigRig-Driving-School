const progressPath = document.querySelector('.backtotop path')
const pathLength = progressPath ? progressPath.getTotalLength() : 0

export function backtotop() {
  return {
    scrolled: false,
    height: 60,
    mobileOpen: false,
    setup() {
      progressPath.style.transition = progressPath.style.WebkitTransition =
        'none'
      progressPath.style.strokeDasharray = pathLength + ' ' + pathLength
      progressPath.style.strokeDashoffset = pathLength
      progressPath.getBoundingClientRect()
      progressPath.style.transition = progressPath.style.WebkitTransition =
        'stroke-dashoffset 10ms linear'
    },
    updateProgress() {
      let scrollValue = window.scrollY
      let scrollHeight = document.body.scrollHeight - window.innerHeight
      let progress = pathLength - (scrollValue * pathLength) / scrollHeight
      progressPath.style.strokeDashoffset = progress
    },
    scroll() {
      this.updateProgress()
      let scrollValue = window.scrollY
      if (scrollValue >= this.height) {
        this.scrolled = true
      } else {
        this.scrolled = false
      }
    },
    scrollTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' })
      return false
    },
  }
}
