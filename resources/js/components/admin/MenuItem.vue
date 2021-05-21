<template>
<div class="box-body">
    <div class="d-flex justify-content-between">
        <v-row @click="[MainRevisingGuid.code[0] !='ع'  ?  SetSelectedRevisingGuid(MainRevisingGuid) : '' ]  " data-toggle="collapse" :data-target="'#'+MainRevisingGuid.code" aria-expanded="false" aria-controls="collapseExample">
            <v-col cols="9">
                <span v-if="MainRevisingGuid.code_alias !== null && MainRevisingGuid.code_alias !=='' ">{{MainRevisingGuid.code_alias}}</span>
                <span v-else>{{MainRevisingGuid.code}}</span>
                -
                <span v-if="MainRevisingGuid.name_alias !== null && MainRevisingGuid.name_alias !== '' "> {{ MainRevisingGuid.name_alias }}</span>
                <span v-else> {{ MainRevisingGuid.name }}</span>

            </v-col>
           <v-col cols="3">
                <v-btn @click="UpdateRevisingGuid(MainRevisingGuid)" fab dark x-small color="primary">
                    <v-icon dark>
                        mdi-pencil
                    </v-icon>
                </v-btn>
            </v-col>
        </v-row>
    </div>

    <div v-if="MainRevisingGuid.code[0] !='ن'" class="collapse bg-white" :id="MainRevisingGuid.code">
        <v-row @click="SetSelectedRevisingGuid(InnerMenuItem)" v-for="InnerMenuItem in MainRevisingGuid.children" :key="InnerMenuItem.code">
            <v-col cols="7" offset="1">
                <span v-if="InnerMenuItem.code_alias !== null && InnerMenuItem.code_alias !==''  ">{{InnerMenuItem.code_alias}}</span>
                <span v-else>{{InnerMenuItem.code}}</span>
                -
                <span v-if="InnerMenuItem.name_alias !== null && InnerMenuItem.name_alias !== '' "> {{ InnerMenuItem.name_alias }}</span>
                <span v-else> {{ InnerMenuItem.name }}</span>

            </v-col>
            <v-col cols="2">
                <v-btn @click="UpdateRevisingGuid(InnerMenuItem)" fab dark x-small color="primary">
                    <v-icon dark>
                        mdi-pencil
                    </v-icon>
                </v-btn>
            </v-col>
        </v-row>
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
            default () {
                return {}
            }
        }

    },
    data() {
        return {
            MainRevisingGuid: this.source,
        }
    },
    methods: {

        dispatch(componentName, eventName, ...rest) {
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
        UpdateRevisingGuid(RevisingGuid) {

            this.dispatch('RevisingGuidManagement', 'UpdateRevisingGuid', RevisingGuid)
        },
        SetSelectedRevisingGuid(RevisingGuid) {
            this.dispatch('RevisingGuidManagement', 'SelectedRevisingGuid', RevisingGuid)

        },
    }
}
</script>

<style scoped>

</style>
