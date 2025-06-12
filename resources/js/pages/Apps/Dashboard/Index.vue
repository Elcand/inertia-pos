<template>
    <Head>
        <title>Dashboard - Cashier App</title>
    </Head>

    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-8">
                        <div
                            v-if="hasAnyPermission(['dashboard.sales_chart'])"
                            class="card border-0 rounded-3 shadow border-top-purple"
                        >
                            <div class="card-header">
                                <span class="font-weight-bold"
                                    ><i class="fa fa-chart-bar"></i> Sales Chart
                                    7 Days</span
                                >
                            </div>
                            <div class="card-body"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div
                            class="card border-0 rounded-3 shadow border-top-info mb-4"
                        >
                            <div class="card-header">
                                <span class="font-weight-bold"
                                    ><i class="fa fa-chart-line"></i> Sales
                                    Today</span
                                >
                            </div>
                            <div class="card-body">
                                <strong>{{ count_sales_today }}</strong> Sales
                                <hr />
                                <h5 class="fw-bold">
                                    Rp. {{ formatPrice(sum_sales_today) }}
                                </h5>
                            </div>
                        </div>

                        <div
                            v-if="hasAnyPermission(['dashboard.profits_today'])"
                            class="card border-0 rounded-3 shadow border-top-success"
                        >
                            <div class="card-header">
                                <span class="font-weight-bold"
                                    ><i class="fa fa-chart-bar"></i> Profits
                                    Today</span
                                >
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold">
                                    Rp. {{ formatPrice(sum_profits_today) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div
                            v-if="
                                hasAnyPermission([
                                    'dashboard.best_selling_product',
                                ])
                            "
                            class="card border-0 rounded-3 shadow border-top-warning"
                        >
                            <div class="card-header">
                                <span class="font-weight-bold"
                                    ><i class="fa fa-chart-pie"></i> Best
                                    Selling Product</span
                                >
                            </div>
                            <div class="card-body"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            v-if="hasAnyPermission(['dashboard.product_stock'])"
                            class="card border-0 rounded-3 shadow border-top-danger"
                        >
                            <div class="card-header">
                                <span class="font-weight-bold"
                                    ><i class="fa fa-box-open"></i> Product
                                    Stock</span
                                >
                            </div>
                            <div class="card-body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import LayoutApp from "../../../Layouts/App.vue";
import { Head } from "@inertiajs/vue3";

export default {
    layout: LayoutApp,

    components: {
        Head,
    },

    props: {
        count_sales_today: Number,
        sum_sales_today: Number,
        sum_profits_today: Number,
    },
};
</script>

<style></style>
