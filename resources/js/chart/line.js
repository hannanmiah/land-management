/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
import {
    BarController,
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
import axios from "axios";

Chart.register(
    LineElement,

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

const res = await axios.get('stats/year-line')

let lineConfig = {
    type: 'line',
    data: {
        labels: Object.keys(res.data.buy),
        datasets: [
            {
                label: 'Buy',
                /**
                 * These colors come from Tailwind CSS palette
                 * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
                 */
                backgroundColor: '#0694a2',
                borderColor: '#0694a2',
                data: Object.values(res.data.buy),
                fill: false,
            },
            {
                label: 'Sell',
                fill: false,
                /**
                 * These colors come from Tailwind CSS palette
                 * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
                 */
                backgroundColor: '#7e3af2',
                borderColor: '#7e3af2',
                data: Object.values(res.data.sell),
            },
        ],
    },
    options: {
        responsive: true,
        /**
         * Default legends are ugly and impossible to style.
         * See examples in charts.html to add your own legends
         *  */
        legend: {
            display: false,
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true,
        },
        scales: {
            x: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month',
                },
            },
            y: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value',
                },
            },
        },
    },
}
const lineCtx = document.getElementById('line')
new Chart(lineCtx, lineConfig)
