<template>
    <a  :style="{color : colorClass}">{{minutes}}:{{seconds}}</a>
</template>

<script>
    export default {
        name: "CountDownTimer",
        data() {
            return {
                now: Math.trunc((new Date()).getTime() / 1e3)
            }
        },
        mounted() {
           window.setInterval(() => {
                this.now = Math.trunc((new Date()).getTime() / 1e3);
            },1e3);

        },
        props: {
            date: {
                type: String
            },
            extension:''
        },

        computed: {
            dateInMilliseconds() {
                return Math.trunc(Date.parse(this.date) / 1e3)
            },
            seconds() {
                if(Math.trunc(this.dateInMilliseconds - this.now) <= 0){
                    axios.post('http://192.168.1.7/admin/changeExtensionStatus',{
                        'extensionNumber':this.extension
                    });
                    return '00';
                }else{
                    if(((this.dateInMilliseconds - this.now) % 60).toString().length === 1){
                        return '0'+((this.dateInMilliseconds - this.now) % 60);
                    }else{
                        return (this.dateInMilliseconds - this.now) % 60;
                    }
                }
            },
            minutes() {
                return Math.trunc(((this.dateInMilliseconds - this.now) / 60));
            },
            colorClass() {
                let color = (this.minutes === 0 ) ? 'red' : 'black';
                return color;
            }
        }
    };
</script>

<style scoped>

</style>
