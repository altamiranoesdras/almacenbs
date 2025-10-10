<script>
import DualListBox from "dual-listbox-vue";
import "dual-listbox-vue/dist/dual-listbox.css";

export default {
    name: "App",
    components: {
        DualListBox
    },
    data: function () {
        return {
            source: [
                { name: "WHITE", code: "#FFFFFF" },
                { name: "SILVER", code: "#C0C0C0" },
                { name: "GRAY", code: "#808080" }
            ],
            destination: [
                { name: "BLACK", code: "#000000" },
                { name: "RED", code: "#FF0000" }
            ]
        };
    },
    methods: {
        onChangeList: function ({ source, destination }) {
            this.source = source;
            this.destination = destination;
        }
    }
};
</script>

<template>
    <DualListBox
        :destination="destination"
        :source="source"
        label="name"
        @onChangeList="onChangeList"
    />
</template>
