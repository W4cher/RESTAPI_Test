<template>
    <div>
        <Navbar />
        <Router-view />
    </div>
</template>

<script>
    import Navbar from "../js/components/Navbar.vue";
    export default {
        name: "app",
        components: {
            Navbar,
        },
    };
</script>
