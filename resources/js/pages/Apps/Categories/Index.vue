<template>
    <Head>
        <title>Categories - Cashier App</title>
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
                                    ><i class="fa fa-folder"></i>
                                    CATEGORIES</span
                                >
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">
                                        <Link
                                            href="/apps/categories/create"
                                            v-if="
                                                hasAnyPermission([
                                                    'categories.create',
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
                                            placeholder="search by category name..."
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Image</th>
                                            <th scope="col" style="width: 20%">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                category, index
                                            ) in categories.data"
                                            :key="index"
                                        >
                                            <td>{{ category.name }}</td>
                                            <td class="text-center">
                                                <img
                                                    :src="`/storage/categories/${category.image}`"
                                                    width="40"
                                                />
                                            </td>
                                            <td class="text-center">
                                                <Link
                                                    :href="`/apps/categories/${category.id}/edit`"
                                                    class="btn btn-success btn-sm me-2"
                                                    ><i
                                                        class="fa fa-pencil-alt me-1"
                                                    ></i>
                                                    Edit</Link
                                                >
                                                <button
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
                                    :links="categories.links"
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
        categories: Object,
    },

    setup() {
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        const handleSearch = () => {
            router.get("/apps/categories", {
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
