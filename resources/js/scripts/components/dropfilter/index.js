export function dropFilter() {
  return {
    isOpen: false,
    activeTab: 'tab-1',
    selectFilter(e) {
      const target = e.target.getAttribute('data-tab')
      this.activeTab = target
    },
    open() {
      this.isOpen = true
    },
    close() {
      this.isOpen = false
    },
  }
}
