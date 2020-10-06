<template>
    <div class="admin-sidebar bg-secondary">
        <div v-show="!expand" class="admin-sidebar-closed  bg-transparent h-100">
            <button @click="barAction" class="p-0 m-2 btn">
                <img src="/images/icons/menu/open.png" class="small-icon">
            </button>
        </div>
        <div v-show="expand" class="admin-sidebar-opened bg-transparent text-light h-100">
            <button @click="barAction" class="p-0 m-2 btn">
                <img src="/images/icons/menu/close.png" class="small-icon">
            </button>
            <ul class="navbar-nav ml-4">
                <li class="nav-item" v-for='(route, index) in routes' :key='index'>
                    <a :href="route.route" class="btn text-light">{{route.index}}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            routes: {
                type: [Array]
            }
        },
        methods: {
            barAction: function () {
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
