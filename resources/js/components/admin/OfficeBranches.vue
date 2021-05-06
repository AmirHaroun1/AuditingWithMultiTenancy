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
            this.GetAllOfficeBranches();
        },
        methods:{
            GetAllOfficeBranches(){
                axios.get(route('OfficeBranches.index')).then(res => {
                    console.log(res);
                }).catch(error => {
                        console.log(error);
                })
            }
        },
}
</script>

<style scoped>

</style>
