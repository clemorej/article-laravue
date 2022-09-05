<template>
    <v-app id="inspire">
        <v-main>
            <keep-alive>
                <router-view></router-view>
            </keep-alive>
        </v-main>
    </v-app>
</template>

<script>

// import Home from '../components/Home'

export default {
    name: 'App',
    components:{
        // Home
    },
    watch: {
        '$route' (to) {
            document.title = to.meta.title || 'JEROMEL CHAVEZ'
        }
    }

}
</script>
