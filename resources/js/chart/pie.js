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
import axios from "axios";

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

const res = await axios.get('/stats/pie')

const pieConfig = {
    type: 'doughnut',
    data: {
        datasets: [
            {
                data: [res.data.Buy, res.data.Sell, res.data.Remain],
                /**
                 * These colors come from Tailwind CSS palette
                 * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
                 */
                backgroundColor: ['#0694a2', '#1c64f2', '#7e3af2'],
                label: 'Dataset 1',
            },
        ],
        labels: ['Buy', 'Sell', 'Remaining'],
    },
    options: {
        responsive: true,
        cutoutPercentage: 80,
        /**
         * Default legends are ugly and impossible to style.
         * See examples in charts.html to add your own legends
         *  */
        legend: {
            display: false,
        },
    },
}
const pieCtx = document.getElementById('pie')
new Chart(pieCtx, pieConfig)
