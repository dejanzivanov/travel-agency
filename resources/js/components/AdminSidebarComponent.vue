

<template>
    <div class="sidebar bg-dark text-white" :class="{ 'expanded': isExpanded }">
        <div class="sidebar-toggle" @click="toggleSidebar">
            <font-awesome-icon icon="fas fa-bars"></font-awesome-icon>
        </div>
        <transition name="slide">
            <div class="sidebar-content" v-show="isExpanded">
                <div class="sidebar-header">
<!--                    <font-awesome-icon icon="fas fa-chevron-right"></font-awesome-icon>-->
<!--                    <font-awesome-icon icon="fas fa-chevron-left"></font-awesome-icon>-->
                </div>
                <div class="sidebar-menu">
                    <div class="sidebar-item justify-content-around" v-on:click="welcomeClick">
                        <font-awesome-icon class="ml-3 mr-5 :class={'flipped': isHovered}" icon="handshake"  />
                        <span>Welcome</span>
                    </div>
                    <div class="sidebar-item justify-content-around" v-on:click="blogClick">
                        <font-awesome-icon class="ml-3 mr-5 :class={'flipped': isHovered}" icon="fas fa-newspaper"  />
                        <span>Blog</span>
                    </div>
                    <div class="sidebar-item justify-content-around" v-on:click="usersClick">
                        <font-awesome-icon class="ml-3 mr-5" icon="fas fa-users"  />
                        <span>Users</span>
                    </div>
                </div>
            </div>
        </transition>
        <button class="btn btn-dark sidebar-button" @click="toggleSidebar">
            <i class="fas fa-cog"></i> Settings
        </button>
    </div>
</template>

<script>
import axios from 'axios';



export default {

    components: {
    },
    data() {
        return {
            isExpanded: false,
        };
    },
    methods: {
        toggleSidebar() {
            this.isExpanded = !this.isExpanded;
        },
        welcomeClick(){
            this.$emit('component-click', 'admin-welcome');
            // const data = { 'component-name': 'admin-welcome' };
            // axios.post('/admin-data', data)
            //     .then(response => {
            //         console.log(response.data);
            //     })
            //     .catch(error => {
            //         console.log(error);
            //     });
        },

        blogClick(){
            this.$emit('component-click', 'blog');

            // const data = { 'component-name': 'blog' };
            // axios.post('/admin-data', data)
            //     .then(response => {
            //         console.log(response.data);
            //     })
            //     .catch(error => {
            //         console.log(error);
            //     });
        },
        usersClick(){
            this.$emit('component-click', 'users');

            // const data = { 'component-name': 'users' };
            // axios.post('/admin-data', data)
            //     .then(response => {
            //         console.log(response.data);
            //     })
            //     .catch(error => {
            //         console.log(error);
            //     });
            },
    },
};


</script>

<style>
.sidebar {
    width: 200px;
    height: 94vh;
    position: fixed;
    //top: 0;
    left: 0;
    bottom: 0;
    overflow: hidden;
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
}

.expanded {
    transform: translateX(0);
}

.sidebar-toggle {
    display: flex;
    justify-content: flex-start;
    padding: 10px;
    cursor: pointer;
}

.sidebar-header {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;
}

.sidebar-header i {
    font-size: 20px;
    transition: all 0.3s ease;
}

.sidebar-menu {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

.sidebar-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    transition: filter 0.3s, outline 0.3s;
    outline: none;
    cursor: pointer;

}
.sidebar-item:hover {
    color: #808080;
    outline: 2px solid white;

}

.flipped {
    color: #808080;
}

.sidebar-item i {
    margin-right: 10px;
}

.sidebar-button {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    border-radius: 50%;
    padding: 10px;
    background-color: #303030;
    border: none;
    color: #fff;
}

.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-enter,
.slide-leave-to {
    transform: translateX(-100%);
}
</style>
