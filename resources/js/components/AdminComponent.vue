<template>
    <div>
        <admin-sidebar-component @component-click="setActiveComponent"></admin-sidebar-component>
        <admin-welcome-component v-if="activeComponent === 'admin-welcome'"></admin-welcome-component>
        <users-component v-if="activeComponent === 'users'"></users-component>
        <blog-component v-if="activeComponent === 'blog'"></blog-component>
        <insurance-component v-if="activeComponent === 'insurance'"></insurance-component>
    </div>
</template>

<script>
import AdminSidebarComponent from './AdminSidebarComponent.vue';
import AdminWelcomeComponent from './AdminWelcomeComponent.vue';
import UsersComponent from './UsersComponent.vue';
import BlogComponent from './BlogComponent.vue';
import InsuranceComponent from './InsuranceComponent.vue';

export default {
    components: {
        AdminSidebarComponent,
        AdminWelcomeComponent,
        UsersComponent,
        BlogComponent,
        InsuranceComponent,
    },
    data() {
        return {
            activeComponent: 'admin-welcome'
        };
    },
    methods: {
        setActiveComponent(componentName) {
            console.log(123)
            this.activeComponent = componentName;
        },
    }
};
</script>
