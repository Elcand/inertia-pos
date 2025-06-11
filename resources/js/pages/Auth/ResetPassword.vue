<template>
    <Head>
        <title>Update Password - Cashier App</title>
    </Head>
    <div class="col-md-4">
        <div class="fade-in">
            <div class="text-center mb-4">
                <a href="" class="text-dark text-decoration-none">
                    <img src="/images/cash-machine.png" width="70" />
                    <h3 class="mt-2 font-weight-bold">Cashier App</h3>
                </a>
            </div>
            <div class="card-group">
                <div
                    class="card border-top-purple border-0 shadow-sm rounded-3"
                >
                    <div class="card-body">
                        <div class="text-start">
                            <h5>UPDATE PASSWORD</h5>
                        </div>
                        <hr />
                        <div
                            v-if="session.status"
                            class="alert alert-success mt-2"
                        >
                            {{ session.status }}
                        </div>
                        <form @submit.prevent="submit">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input
                                    class="form-control"
                                    v-model="form.email"
                                    :class="{ 'is-invalid': errors.email }"
                                    type="email"
                                    placeholder="Email Address"
                                />
                            </div>
                            <div v-if="errors.email" class="alert alert-danger">
                                {{ errors.email }}
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input
                                    class="form-control"
                                    v-model="form.password"
                                    :class="{ 'is-invalid': errors.password }"
                                    type="password"
                                    placeholder="Password"
                                />
                            </div>
                            <div
                                v-if="errors.password"
                                class="alert alert-danger"
                            >
                                {{ errors.password }}
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input
                                    class="form-control"
                                    v-model="form.password_confirmation"
                                    :class="{
                                        'is-invalid':
                                            errors.password_confirmation,
                                    }"
                                    type="password"
                                    placeholder="Password Confirmation"
                                />
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button
                                        class="btn btn-primary shadow-sm rounded-sm px-4 w-100"
                                        type="submit"
                                    >
                                        UPDATE PASSWORD
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAuth from "../../layouts/Auth.vue";
import { reactive } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";

export default {
    layout: LayoutAuth,
    components: {
        Head,
        Link,
    },
    props: {
        errors: Object,
        token: String,
        email: String,
        session: Object,
    },
    setup(props) {
        const form = reactive({
            email: props.email,
            password: "",
            password_confirmation: "",
            token: props.token,
        });
        const submit = () => {
            router.post("/reset-password", {
                email: form.email,
                password: form.password,
                password_confirmation: form.password_confirmation,
                token: form.token,
            });
        };
        return {
            form,
            submit,
        };
    },
};
</script>

<style></style>
