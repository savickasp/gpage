<template>
    <div class="admin-sidebar bg-dark text-light">
        <button v-show="expand" @click="barAction" class="p-0 m-2">
            <i class="fas fa-bars p-0 m-0 sq-icon-medium"></i>
        </button>
        <button v-show="!expand" @click="barAction" class="p-0 m-2">
            <i class="far fa-window-close bg-dark"></i>
        </button>
        <div v-if="expand" class="admin-sidebar-expanded bg-danger">
            fffffff
        </div>
    </div>
</template>

<script>
    export default {

        methods: {
            barAction: function () {
                console.log('asdsad');
                this.expand = !this.expand;
            }
        },
        data() {
            return {
                expand: false
            }
        }
    }
</script>
