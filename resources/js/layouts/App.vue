<template>
    <div class="c-app">
        <div
            class="c-sidebar c-sidebar-dark c-sidebar-fixed"
            :class="{
                'c-sidebar-lg-show':
                    !$page.url.startsWith('/apps/transactions'),
            }"
            id="sidebar"
        >
            <div
                class="c-sidebar-brand d-lg-down-none"
                style="background: #894b9d"
            >
                <img
                    src="/images/cash-machine.png"
                    class="bg-light rounded shadow-sm p-1"
                    width="35"
                />
                <span class="ml-2 font-weight-bold">Cashier App</span>
            </div>
            <Sidebar />
        </div>
        <div class="c-wrapper c-fixed-components">
            <Header />
            <div class="c-body">
                <slot />
                <footer class="c-footer">
                    <div>
                        <strong>Cashier App</strong> &copy; 2025 -
                        name_domain.com.
                    </div>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../Components/Header.vue";
import Sidebar from "../Components/Sidebar.vue";

export default {
    components: {
        Header,
        Sidebar,
    },
};
</script>

<style></style>
