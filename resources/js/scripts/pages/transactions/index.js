export function transactions() {
  return {
    isLoading: true,
    init() {
      const _this = this
      setTimeout(() => {
        _this.isLoading = false
      }, 2000)
    },
  }
}
