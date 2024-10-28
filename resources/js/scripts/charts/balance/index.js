import ApexCharts from 'apexcharts'
import { colors } from '../../utils/colors'

export function balanceChart() {
  const balanceChart = document.getElementById('balance-chart')

  if (typeof balanceChart != 'undefined' && balanceChart != null) {
    const balanceChartOptions = {
      series: [
        {
          name: 'Returning',
          data: [31, 40, 28, 51, 42, 109, 100],
        },
      ],
      chart: {
        height: 250,
        type: 'area',
        toolbar: {
          show: false,
        },
        parentHeightOffset: 0,
      },
      colors: [colors.primary],
      legend: {
        show: false,
        position: 'top',
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: [2, 2, 2],
        curve: 'smooth',
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          inverseColors: false,
          shadeIntensity: 0.5,
          colorStops: [
            {
              offset: 0,
              color: colors.primary,
              opacity: 1,
            },
            {
              offset: 100,
              color: colors.areaGradient,
              opacity: 1,
            },
          ],
        },
      },
      grid: {
        show: false,
        padding: {
          left: -10,
          right: 0,
          bottom: 10,
        },
      },
      xaxis: {
        type: 'datetime',
        categories: [
          '2022-09-19T00:00:00.000Z',
          '2022-09-20T01:30:00.000Z',
          '2022-09-21T02:30:00.000Z',
          '2022-09-22T03:30:00.000Z',
          '2022-09-23T04:30:00.000Z',
          '2022-09-24T05:30:00.000Z',
          '2022-09-25T06:30:00.000Z',
        ],
      },
      yaxis: {
        labels: {
          show: false,
          offsetX: -15,
        },
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm',
        },
      },
    }

    const balanceChartInstance = new ApexCharts(
      balanceChart,
      balanceChartOptions
    )

    balanceChartInstance.render()
  }
}
