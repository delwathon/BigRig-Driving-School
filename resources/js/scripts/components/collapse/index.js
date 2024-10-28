export function collapse() {
  return {
    isOpen: false,
    open() {
      this.isOpen = true
    },
    close() {
      this.isOpen = false
    },
  }
}
