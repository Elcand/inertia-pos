<template>
    <Head>
        <title>Add New Category - Cashier App</title>
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
                                    ><i class="fa fa-folder"></i> ADD NEW
                                    CATEGORY</span
                                >
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submit">
                                    <div class="mb-3">
                                        <input
                                            class="form-control"
                                            @input="
                                                form.image =
                                                    $event.target.files[0]
                                            "
                                            :class="{
                                                'is-invalid': errors.image,
                                            }"
                                            type="file"
                                        />
                                    </div>
                                    <div
                                        v-if="errors.image"
                                        class="alert alert-danger"
                                    >
                                        {{ errors.image }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold"
                                            >Category Name</label
                                        >
                                        <input
                                            class="form-control"
                                            v-model="form.name"
                                            :class="{
                                                'is-invalid': errors.name,
                                            }"
                                            type="text"
                                            placeholder="Category Name"
                                        />
                                    </div>
                                    <div
                                        v-if="errors.name"
                                        class="alert alert-danger"
                                    >
                                        {{ errors.name }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold"
                                            >Description</label
                                        >
                                        <textarea
                                            class="form-control"
                                            v-model="form.description"
                                            :class="{
                                                'is-invalid':
                                                    errors.description,
                                            }"
                                            type="text"
                                            rows="4"
                                            placeholder="Description"
                                        ></textarea>
                                    </div>
                                    <div
                                        v-if="errors.description"
                                        class="alert alert-danger"
                                    >
                                        {{ errors.description }}
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button
                                                class="btn btn-primary shadow-sm rounded-sm"
                                                type="submit"
                                            >
                                                SAVE
                                            </button>
                                            <button
                                                class="btn btn-warning shadow-sm rounded-sm ms-3"
                                                type="reset"
                                            >
                                                RESET
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
import { Head, Link, router } from "@inertiajs/vue3";
import { reactive } from "vue";
import Swal from "sweetalert2";

export default {
    layout: LayoutApp,

    components: {
        Head,
        Link,
    },

    props: {
        errors: Object,
    },

    setup() {
        const form = reactive({
            name: "",
            image: "",
            description: "",
        });

        const submit = () => {
            router.post(
                "/apps/categories",
                {
                    name: form.name,
                    image: form.image,
                    description: form.description,
                },
                {
                    onSuccess: () => {
                        Swal.fire({
                            title: "Success!",
                            text: "Category saved successfully.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                }
            );
        };

        return {
            form,
            submit,
        };
    },
};
</script>

<style></style>
