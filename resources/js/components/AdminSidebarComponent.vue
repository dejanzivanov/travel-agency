

<template>
    <div class="sidebar text-white" :class="{ 'expanded': isExpanded, }">
        <div :class="{ 'sidebar-toggle': true, 'sidebar-open': sidebarOpen   }" @click="toggleSidebar" style="transition: all 0.3s ease !important;">
            <font-awesome-icon icon="fas fa-bars" class="sidebar-toggle-icon"></font-awesome-icon>
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

                    <div class="sidebar-item justify-content-around" v-on:click="insuranceClick">
                        <font-awesome-icon class="ml-3 mr-5" icon="fas fa-shield-alt"  />
                        <span>Insurance</span>
                    </div>
                </div>
            </div>
        </transition>
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
            sidebarOpen: false,
        };
    },
    methods: {
        toggleSidebar() {
            this.isExpanded = !this.isExpanded;
            this.sidebarOpen = !this.sidebarOpen;
        },
        welcomeClick()
        {
            this.$emit('component-click', 'admin-welcome');
        },

        blogClick()
        {
            this.$emit('component-click', 'blog');
        },
        usersClick()
        {
            this.$emit('component-click', 'users');
        },
        insuranceClick()
        {
            this.$emit('component-click', 'insurance');
        }
    },
};


</script>

<style scoped>
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
    z-index: 100;
}

.sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #212529;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: -1;
}

.expanded {
    transform: translateX(0);

}

.sidebar-open
{
    //transition: all 0.3s ease !important;
    left:calc(100% - 33px)!important;
}

.expanded::before {
    opacity: 1;
}

.sidebar-toggle {
    display: flex;
    justify-content: flex-start;
    padding: 10px;
    cursor: pointer;
    position: absolute;
    top: 47%;
    left: -7px;
    transition: all 0.3s ease !important;
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

.sidebar-toggle-icon {
    font-size: 24px; /* Adjust the font size as desired */
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
