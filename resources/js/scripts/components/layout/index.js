export function layout() {
  return {
    dark: false,
    initTheme() {
      if (this.$store.app.isDark) {
        document.documentElement.classList.add('dark')
        this.dark = true
      } else {
        document.documentElement.classList.remove('dark')
        this.dark = false
      }
    },

    toggleTheme() {
      this.$store.app.isDark = !this.$store.app.isDark
      this.dark = !this.dark
    },
  }
}
