export function payments() {
  return {
    isLoading: true,
    init() {
      const _this = this
      setTimeout(() => {
        _this.isLoading = false
      }, 2000)
    },
    activeTab: 'tab-1',
    toggle(e) {
      const _this = this
      this.isLoading = true
      const target = e.target.getAttribute('data-tab')
      this.activeTab = target
      setTimeout(() => {
        _this.isLoading = false
      }, 2000)
    },
  }
}
