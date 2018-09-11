<template>
    <div>
        <canvas width="600" height="400" ref="canvas"></canvas>
    </div>
</template>

<script>
    import axios from 'axios';
    import Chart from 'chart.js';
    export default {
        props: ['url'],

        mounted() {
            axios.get(this.url).then(response => {
                const data = response.data;
                console.log(data);
                let months = [
                    'January', 'February', 'March', 'April', 'May',
                    'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ];

                this.render({
                    labels: Object.keys(data).map(key => months[key]),
                    datasets: [
                        {
                            label: "Threads",
                            fillColor: this.color,
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: Object.keys(data).map(key => data[key])
                        },
                    ]
                });
            });
        },

        methods: {
            render(data){
                new Chart( this.$refs.canvas.getContext('2d'),
                    {
                        type: "line",
                        data: data
                    });
            }
        }
    };
</script>

