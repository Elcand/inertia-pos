<template>
    <Head>
        <title>Products - Cashier App</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div
                            class="card border-0 rounded-3 shadow border-top-purple"
                        >
                            <div class="card-header">
                                <span class="font-weight-bold"
                                    ><i class="fa fa-shopping-bag"></i>
                                    PRODUCTS</span
                                >
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">
                                        <Link
                                            href="/apps/products/create"
                                            v-if="
                                                hasAnyPermission([
                                                    'products.create',
                                                ])
                                            "
                                            class="btn btn-primary input-group-text"
                                        >
                                            <i
                                                class="fa fa-plus-circle me-2"
                                            ></i>
                                            Add</Link
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="search"
                                            placeholder="search by product title..."
                                        />

                                        <button
                                            class="btn btn-primary input-group-text"
                                            type="submit"
                                        >
                                            <i class="fa fa-search me-2"></i>
                                            SEARCH
                                        </button>
                                    </div>
                                </form>
                                <table
                                    class="table table-striped table-bordered table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col">Barcode</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Buy Price</th>
                                            <th scope="col">Sell Price</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col" style="width: 20%">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                product, index
                                            ) in products.data"
                                            :key="index"
                                        >
                                            <td class="text-center">
                                                {{ product.barcode }}
                                            </td>
                                            <td>{{ product.title }}</td>
                                            <td>
                                                Rp.
                                                {{
                                                    formatPrice(
                                                        product.buy_price
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                Rp.
                                                {{
                                                    formatPrice(
                                                        product.sell_price
                                                    )
                                                }}
                                            </td>
                                            <td>{{ product.stock }}</td>
                                            <td class="text-center">
                                                <Link
                                                    :href="`/apps/products/${product.id}/edit`"
                                                    v-if="
                                                        hasAnyPermission([
                                                            'products.edit',
                                                        ])
                                                    "
                                                    class="btn btn-success btn-sm me-2"
                                                    ><i
                                                        class="fa fa-pencil-alt me-1"
                                                    ></i>
                                                    Edit</Link
                                                >
                                                <button
                                                    v-if="
                                                        hasAnyPermission([
                                                            'products.delete',
                                                        ])
                                                    "
                                                    class="btn btn-danger btn-sm"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination
                                    :links="products.links"
                                    align="end"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import LayoutApp from "../../../Layouts/App.vue";
import Pagination from "../../../Components/Pagination.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

export default {
    layout: LayoutApp,

    components: {
        Head,
        Link,
        Pagination,
    },

    props: {
        products: Object,
    },

    setup() {
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        const handleSearch = () => {
            router.get("/apps/products", {
                q: search.value,
            });
        };

        return {
            search,
            handleSearch,
        };
    },
};
</script>

<style></style>
