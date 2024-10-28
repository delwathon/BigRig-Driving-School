export function tabs() {
  return {
    activeTab: 'tab-1',
    toggle(e) {
      const target = e.target.getAttribute('data-tab')
      this.activeTab = target
    },
  }
}
