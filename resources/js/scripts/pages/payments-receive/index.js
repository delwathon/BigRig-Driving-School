import { format } from 'numerable'

export function receivePayment() {
  return {
    isLoading: false,
    isComplete: false,
    recipient: '',
    paymentMethod: 'transfer',
    amount: null,
    email: null,
    formatAmount() {
      return format(this.amount, '0,0.00')
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
