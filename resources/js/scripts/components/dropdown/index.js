export function dropdown() {
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
