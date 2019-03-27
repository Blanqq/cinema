<template>
    <div>
        <form :action="computedRoute">
            <select class="btn-lg" v-model="selectedCinema">
                <option value="">Please select your cinema</option>
                <option v-for="cinema in cinemas" :value="cinema.id">{{cinema.name}}</option>
            </select>
            <button class="btn btn-outline-light btn-lg" v-show="selectedCinema">Go Reserve Tickets</button>
        </form>
    </div>

</template>

<script>
    export default {
        props: ['dataCinemas'],

        data() {
            return{
                selectedCinema: '',
                cinemas: this.dataCinemas,
            }
        },
        computed:{
            computedRoute: function () {
                return '/'+this.selectedCinema;
            }
        },
    }
</script>

<style scoped>

</style>