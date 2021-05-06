<template>
<div>

</div>
</template>

<script>
export default {
    name: "OfficeBranches",
    data() {
        return {

        }
    },
    created() {
        this.getAllBranches()
    },
    methods: {
        getAllBranches() {
            axios.get(route('OfficeBranches.index')).then((result) => {
                console.log('res', result);
            }).catch((err) => {
                console.log('err', err);
            });
        }
    }
}
</script>

<style scoped>

</style>
