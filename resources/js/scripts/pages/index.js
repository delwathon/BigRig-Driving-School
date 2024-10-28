import { dashboard } from './dashboard'
import { transactions } from './transactions'
import { payments } from './payments'
import { cards } from './cards'
import { sendPayment } from './payments-send'
import { receivePayment } from './payments-receive'
import { createCard } from './cards-create'

window.dashboard = dashboard
window.transactions = transactions
window.payments = payments
window.cards = cards
window.sendPayment = sendPayment
window.receivePayment = receivePayment
window.createCard = createCard
