import { balanceChart } from '../../charts/balance'

export function dashboard() {
  return {
    init() {
      balanceChart()
    },
  }
}
