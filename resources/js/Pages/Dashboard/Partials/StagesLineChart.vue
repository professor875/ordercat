<script setup lang="ts">
import {onMounted, ref} from 'vue'
// @ts-ignoreimport StagesLineChart from "@/Pages/Dashboard/Partials/StagesLineChart.vue";
import {trans} from "@/utils.js";
import VueApexCharts from 'vue3-apexcharts';
import axios from "axios";

const period = ref('daily')

const series = ref([{
    name: trans('Stage'),
    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30, 45]
}]);

const chartData = ref({
    series: [
        {
            name: trans('Stage'),
            data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30, 45]
        },
    ],
    labels: [trans('Sep'), trans('Oct'), trans('Nov'), trans('Dec'), trans('Jan'), trans('Feb'), trans('Mar'), trans('Apr'), trans('May'), trans('Jun'), trans('Jul'), trans('Aug')]
})

const chart = ref(null)

const apexOptions = ref({
    legend: {
        show: false,
        position: 'top',
        horizontalAlign: 'left'
    },
    colors: ['#3C50E0', '#80CAEE'],
    chart: {
        fontFamily: 'Satoshi, sans-serif',
        height: 335,
        type: 'area',
        dropShadow: {
            enabled: true,
            color: '#623CEA14',
            top: 10,
            blur: 4,
            left: 0,
            opacity: 0.1
        },

        toolbar: {
            show: false
        }
    },
    responsive: [
        {
            breakpoint: 1024,
            options: {
                chart: {
                    height: 300
                }
            }
        },
        {
            breakpoint: 1366,
            options: {
                chart: {
                    height: 350
                }
            }
        }
    ],
    stroke: {
        width: [2, 2],
        curve: 'straight'
    },

    labels: {
        show: false,
        position: 'top'
    },
    grid: {
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    dataLabels: {
        enabled: false
    },
    markers: {
        size: 4,
        colors: '#fff',
        strokeColors: ['#3056D3', '#80CAEE'],
        strokeWidth: 3,
        strokeOpacity: 0.9,
        strokeDashArray: 0,
        fillOpacity: 1,
        discrete: [],
        hover: {
            size: undefined,
            sizeOffset: 5
        }
    },
    xaxis: {
        type: 'category',
        categories: chartData.value.labels,
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        }
    },
    yaxis: {
        title: {
            style: {
                fontSize: '0px'
            }
        },
        min: 0,
        max: 100
    }
})
const switchChart = (value) => {
    period.value = value;
    fetchChart();
}

const fetchChart = () => {
    axios.post(route('dashboard.stages-line-chart', period.value)).then(response => {
        series.value[0].data = response.data.chart.data

        apexOptions.value = {
            ...apexOptions.value,
            xaxis: {
                ...apexOptions.value.xaxis,
                categories: response.data.chart.labels,
            },
            yaxis: {
                ...apexOptions.value.yaxis,
                max: Math.max(...response.data.chart.data) + 10,
            }
        }
    })
}

onMounted(() => {
    fetchChart();
})
</script>

<template>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-8"
    >
        <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
            <div class="flex w-full flex-wrap gap-3 sm:gap-5">
                <div class="flex min-w-47.5">
                    <div class="w-full">
                        <h4 class="text-xl font-bold text-black dark:text-white">{{trans('Stages Chart')}}</h4>
                    </div>
                </div>
            </div>
            <div class="flex w-full max-w-45 justify-end">
                <div class="inline-flex items-center rounded-md bg-whiter p-1.5 dark:bg-meta-4">
                    <button
                        class="rounded bg-white py-1 px-3 text-xs font-medium text-black shadow-card hover:bg-white hover:shadow-card dark:bg-boxdark dark:text-white dark:hover:bg-boxdark"
                        @click="switchChart('daily')"
                    >
                        {{trans('Day')}}
                    </button>
                    <button
                        class="rounded py-1 px-3 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark"
                        @click="switchChart('weekly')"
                    >
                        {{trans('Week')}}
                    </button>
                    <button
                        class="rounded py-1 px-3 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark"
                        @click="switchChart('monthly')"
                    >
                        {{trans('Month')}}
                    </button>
                </div>
            </div>
        </div>
        <div>
            <div id="chartOne" class="-ml-5">
                <VueApexCharts
                    type="area"
                    height="350"
                    :options="apexOptions"
                    :series="series"
                    ref="chart"
                />
            </div>
        </div>
    </div>
</template>
