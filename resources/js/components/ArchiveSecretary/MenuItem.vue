<template>
    <div class="box-body">
        <h5 @click="[source.code[0] !='ع' ?  UpdateSelectedItem(source) : '' ]  "
            class="verticalMenuItem cursor-pointer "
           data-toggle="collapse" :data-target="'#'+source.code" aria-expanded="false" aria-controls="collapseExample">

            <b v-if="source.code_alias">{{source.code_alias}}</b>
            <b v-else>{{source.code}}</b>
                -
            <b v-if="source.name_alias"> {{ source.name_alias }}</b>
            <b v-else> {{ source.name }}</b>

        </h5>
        <div v-if="source.code[0] !='ن'" class="collapse bg-white"  :id="source.code">
            <div class="pt-5 verticalMenuSubItem " v-for="InnerMenuItem in source.children">
                <h5 class="cursor-pointer verticalMenuSubItemText " @click="UpdateSelectedItem(InnerMenuItem)">
                    <b v-if="InnerMenuItem.code_alias">{{InnerMenuItem.code_alias}}</b>
                    <b v-else>{{InnerMenuItem.code}}</b>
                    -
                    <b v-if="InnerMenuItem.name_alias"> {{ InnerMenuItem.name_alias }}</b>
                    <b v-else> {{ InnerMenuItem.name }}</b>
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
            UpdateSelectedItem (InnerMenuItem) {
                this.dispatch('ArchiveEditTransaction','checkSelectedItemChange', InnerMenuItem)
            }

        }
    }
</script>
<style scoped>

</style>
