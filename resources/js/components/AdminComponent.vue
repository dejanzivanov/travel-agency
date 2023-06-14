<template>
    <div>
        <admin-sidebar-component @component-click="setActiveComponent"></admin-sidebar-component>
        <admin-welcome-component v-if="activeComponent === 'admin-welcome'"></admin-welcome-component>
        <users-component v-if="activeComponent === 'users'"></users-component>
        <blog-component v-if="activeComponent === 'blog'"></blog-component>
    </div>
</template>

<script>
import AdminSidebarComponent from './AdminSidebarComponent.vue';
import AdminWelcomeComponent from './AdminWelcomeComponent.vue';
import UsersComponent from './UsersComponent.vue';
import BlogComponent from './BlogComponent.vue';

export default {
    components: {
        AdminSidebarComponent,
        AdminWelcomeComponent,
        UsersComponent,
        BlogComponent
    },
    data() {
        return {
            activeComponent: 'admin-welcome'
        };
    },
    methods: {
        setActiveComponent(componentName) {
            this.activeComponent = componentName;
        },
    }
};
</script>
