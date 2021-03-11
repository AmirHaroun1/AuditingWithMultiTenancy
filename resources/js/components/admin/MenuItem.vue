<template>
    <div class="box-body">
        <div  class="d-flex justify-content-between">
                <h5 @click="[MainRevisingGuid.code[0] !='ع'  ?  SetSelectedRevisingGuid(MainRevisingGuid) : '' ]  "
                    class="verticalMenuItem cursor-pointer "
                    data-toggle="collapse" :data-target="'#'+MainRevisingGuid.code" aria-expanded="false" aria-controls="collapseExample">

                    <b v-if="MainRevisingGuid.code_alias !== null && MainRevisingGuid.code_alias !=='' ">{{MainRevisingGuid.code_alias}}</b>
                    <b v-else>{{MainRevisingGuid.code}}</b>
                    -
                    <b v-if="MainRevisingGuid.name_alias !== null && MainRevisingGuid.name_alias !== '' "> {{ MainRevisingGuid.name_alias }}</b>
                    <b v-else> {{ MainRevisingGuid.name }}</b>

                    <i @click="UpdateRevisingGuid(MainRevisingGuid)" class="fa fa-edit pull-left fa-2x"></i>

                </h5>

        </div>

        <div v-if="MainRevisingGuid.code[0] !='ن'" class="collapse bg-white"  :id="MainRevisingGuid.code">
            <div class="pt-5 verticalMenuSubItem " v-for="InnerMenuItem in MainRevisingGuid.children">
                <h5 class="cursor-pointer verticalMenuSubItemText " @click="SetSelectedRevisingGuid(InnerMenuItem)">
                    <b v-if="InnerMenuItem.code_alias !== null && InnerMenuItem.code_alias !==''  ">{{InnerMenuItem.code_alias}}</b>
                    <b v-else>{{InnerMenuItem.code}}</b>
                    -
                    <b v-if="InnerMenuItem.name_alias !== null && InnerMenuItem.name_alias !== '' "> {{ InnerMenuItem.name_alias }}</b>
                    <b v-else> {{ InnerMenuItem.name }}</b>

                    <i @click="UpdateRevisingGuid(InnerMenuItem)" style="font-size:20px" class="fa fa-edit pull-left "></i>

                </h5>
            </div>
        </div>




    </div>

</template>
<script>
    export default {
        name: "MenuItem",
        props: {
            index: {
                type: Number
            },
            source: {
                type: Object,
                default() {
                    return {}
                }
            }

        },
        data() {
            return{
                MainRevisingGuid : this.source,
            }
        },
        methods : {

            dispatch (componentName, eventName, ...rest) {
                let parent = this.$parent || this.$root
                let name = parent.$options.name

                while (parent && (!name || name !== componentName)) {
                    parent = parent.$parent
                    if (parent) {
                        name = parent.$options.name
                    }
                }
                if (parent) {
                    parent.$emit.apply(parent, [eventName].concat(rest))
                }
            },
            UpdateRevisingGuid (RevisingGuid) {

                this.dispatch('RevisingGuidManagement','UpdateRevisingGuid', RevisingGuid)
            },
            SetSelectedRevisingGuid(RevisingGuid){
                this.dispatch('RevisingGuidManagement','SelectedRevisingGuid', RevisingGuid)

            },
        }
    }
</script>
<style scoped>

</style>
