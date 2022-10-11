import {
    ArcElement,
    BarController,
    BarElement,
    BubbleController,
    CategoryScale,
    Chart,
    Decimation,
    DoughnutController,
    Filler,
    Legend,
    LinearScale,
    LineController,
    LineElement,
    LogarithmicScale,
    PieController,
    PointElement,
    PolarAreaController,
    RadarController,
    RadialLinearScale,
    ScatterController,
    SubTitle,
    TimeScale,
    TimeSeriesScale,
    Title,
    Tooltip
} from 'chart.js';
import instance from "../services/base";

Chart.register(
    ArcElement,
    LineElement,
    BarElement,
    PointElement,
    BarController,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip,
    SubTitle
);

const res = await instance.get('stats/line')
const keys = Object.keys(res.data.buy)

const sellRes = await instance.get('stats/bar')
const buyData = sellRes.data.buy
const sellData = sellRes.data.sell
const buyKeys = []
const buyValues = []
const sellValues = []

buyData.forEach(v => {
    buyKeys.push(Object.keys(v)[0])
    buyValues.push(Object.values(v)[0])
})

sellData.forEach(val => {
    sellValues.push(Object.values(val)[0])
})


const sellConfig = {
    type: 'bar',
    data: {
        labels: buyKeys,
        datasets: [
            {
                label: 'Buy',
                backgroundColor: '#0694a2',
                // borderColor: window.chartColors.red,
                borderWidth: 1,
                data: buyValues,
            },
            {
                label: 'Sell',
                backgroundColor: '#7e3af2',
                // borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: sellValues,
            },
        ],
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
    },
}
const barConfig = {
    type: 'bar',
    data: {
        labels: keys,
        datasets: [
            {
                label: 'Sell',
                backgroundColor: '#0694a2',
                // borderColor: window.chartColors.red,
                borderWidth: 1,
                data: Object.values(res.data.sell),
            },
            {
                label: 'Buy',
                backgroundColor: '#7e3af2',
                // borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: Object.values(res.data.buy),
            },
        ],
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
    },
}
const barsCtx = document.getElementById('bars')
const sellCtx = document.getElementById('sells')
new Chart(barsCtx, barConfig)
new Chart(sellCtx, sellConfig)
