<template>
    <div>
        <div v-if="signedIn || onlyBrowse">
            <form :action="computedRoute">
                <select class="btn-lg" v-model="selectedCinema">
                    <option value="">Please select your cinema</option>
                    <option v-for="cinema in cinemas" :value="cinema.id">{{cinema.name}}</option>
                </select><br>
                <button class="btn btn-outline-light btn-lg" v-show="selectedCinema">Go Reserve Tickets</button>
            </form>
        </div>
        <div v-else>
            <div style="padding: 25px">
                <h3>Please register or login to buy tickets</h3>
                <a href="/register" class="btn btn-outline-light btn-lg">Register</a>
                <a href="/login" class="btn btn-outline-light btn-lg">Login</a>
            </div>

            <div style="padding: 25px">
                <h3>or click button below</h3>
                <button class="btn btn-outline-success btn-lg"
                        @click="onlyBrowse = true">I JUST WANT TO SEE SHOWS!!</button>
            </div>

        </div>
    </div>


</template>

<script>
    export default {
        props: ['dataCinemas'],

        data() {
            return{
                selectedCinema: '',
                onlyBrowse: false,
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