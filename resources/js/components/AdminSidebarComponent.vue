

<template>
    <div class="sidebar bg-dark text-white" :class="{ 'expanded': isExpanded }">
        <div class="sidebar-toggle" @click="toggleSidebar">
            <i class="fas fa-bars"></i>
        </div>
        <transition name="slide">
            <div class="sidebar-content" v-show="isExpanded">
                <div class="sidebar-header">
                    <i class="fas fa-chevron-right"></i>
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="sidebar-menu">
                    <div class="sidebar-item justify-content-around">
                        <font-awesome-icon class="ml-3 mr-5 :class={'flipped': isHovered}" icon="fas fa-newspaper"  />
                        <span>Posts</span>
                    </div>
                    <div class="sidebar-item justify-content-around">
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

export default {

    components: {
        // FontAwesomeIcon,
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
