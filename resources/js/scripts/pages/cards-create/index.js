export function createCard() {
  return {
    isLoading: false,
    isComplete: false,
    cardAccountNumber: 4869,
    cardAccountType: 'checking',
    cardAccountBalance: '9,384.21',
    cardholder: 'Mara Callaway',
    cardType: 'New',
    cardLimit: 'Daily',
    cardSpendingLimit: 100.0,
    getAccountlogWithSource(e) {
      const accountNumber = e.target.getAttribute('data-number')
      const accountBalance = e.target.getAttribute('data-balance')
      const accountType = e.target.getAttribute('data-type')
      this.cardAccountNumber = accountNumber
      this.cardAccountBalance = accountBalance
      this.cardAccountType = accountType
    },
    issueCard() {
      const _this = this
      _this.isLoading = true
      setTimeout(() => {
        _this.isComplete = true
        _this.isLoading = false
      }, 1800)
    },
  }
}
