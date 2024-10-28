import { format } from 'numerable'

export function sendPayment() {
  return {
    isLoading: false,
    isComplete: false,
    balance: 9384.21,
    recipient: '',
    paymentMethod: 'ACH',
    routingNumber: null,
    addressMain: '',
    addressSub: '',
    postalCode: '',
    city: '',
    state: '',
    country: 'United States',
    amount: null,
    formatAmount() {
      return format(this.amount, '0,0.00')
    },
    setBalanceLimit() {
      if (this.amount > this.balance) {
        this.amount = this.balance
      }
    },
    sendRequest() {
      const _this = this
      _this.isLoading = true
      setTimeout(() => {
        _this.isComplete = true
        _this.isLoading = false
      }, 1800)
    },
  }
}
