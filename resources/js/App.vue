<template>
    <div>
        <Navbar />
        <Router-view />
    </div>
</template>

<script>
export default {
    name: "app",
    components: {
        Navbar,
    },
};
</script>
