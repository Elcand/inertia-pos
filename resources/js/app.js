import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .mixin({
                methods: {
                    hasAnyPermission: function (permissions) {
                        let allPermissions = this.$page.props.auth.permissionsl;
                        let hasPermission = false;
                        permissions.forEach(function (item) {
                            if (allPermissions[item]) hasPermission = true;
                        });
                        return hasPermission;   
                    },
                },
            })
            .use(plugin)
            .mount(el);
    },
    progress: {
        delay: 250,
        color: "#29d",
        includeCSS: true,
        showSpinner: false,
    },
});
